const fs = require('fs');
const path = require('path');

const ROOT_VIEWS = path.join(process.cwd(), 'resources', 'views');
const PUBLIC_DIR = path.join(process.cwd(), 'public');
const PUBLIC_IMAGES = path.join(PUBLIC_DIR, 'images');

const exts = ['png','jpg','jpeg','gif','svg','webp'];
const extGroup = exts.map(e => e.replace('.', '\.')).join('|');

// Matches: asset('images/foo.png') or asset("images/foo.png")
const reAsset = new RegExp(
  String.raw`asset\(\s*['"](images\/[^'"]+\.(${extGroup}))['"]\s*\)`,
  'gi'
);

// Matches: /images/foo.png
const reSlash = new RegExp(
  String.raw`['"]\/(images\/[^'"]+\.(${extGroup}))['"]`,
  'gi'
);

function walk(dir) {
  let out = [];
  for (const ent of fs.readdirSync(dir, { withFileTypes: true })) {
    const p = path.join(dir, ent.name);
    if (ent.isDirectory()) out = out.concat(walk(p));
    else if (ent.isFile() && p.endsWith('.blade.php')) out.push(p);
  }
  return out;
}

const refs = new Set();
const files = walk(ROOT_VIEWS);
for (const file of files) {
  const s = fs.readFileSync(file, 'utf8');
  let m;
  while ((m = reAsset.exec(s)) !== null) {
    refs.add(m[1]);
  }
  while ((m = reSlash.exec(s)) !== null) {
    refs.add(m[1]);
  }
}

const referenced = [...refs].sort();
const missing = referenced.filter(rel => {
  const fp = path.join(PUBLIC_DIR, rel);
  return !fs.existsSync(fp);
});

console.log(JSON.stringify({
  referencedCount: referenced.length,
  missingCount: missing.length,
  missing
}, null, 2));

