import * as THREE from "three";
import { OrbitControls } from 'jsm/controls/OrbitControls.js';
import { Lensflare, LensflareElement } from 'jsm/objects/Lensflare.js'; // นำเข้า Lensflare

import getStarfield from "./src/getStarfieldX6.js";
import { getFresnelMat } from "./src/getFresnelMatX6.js";

// ตั้งค่าขนาดหน้าต่างและสร้างฉาก
const w = window.innerWidth;
const h = window.innerHeight;
const scene = new THREE.Scene(); // สร้างฉากหลัก
const camera = new THREE.PerspectiveCamera(75, w / h, 0.1, 1000); // สร้างกล้องมุมมอง
camera.position.z = 5; // ตั้งตำแหน่งกล้อง
const renderer = new THREE.WebGLRenderer({ antialias: true }); // สร้าง renderer สำหรับการเรนเดอร์ภาพ
renderer.setSize(w, h); // กำหนดขนาดของ renderer ตามขนาดหน้าต่าง
document.body.appendChild(renderer.domElement); // ใส่ renderer ใน DOM

// กำหนด tone mapping และ color space
renderer.toneMapping = THREE.ACESFilmicToneMapping;
renderer.outputColorSpace = THREE.LinearSRGBColorSpace;

// สร้างกลุ่มโมเดลโลก
const earthGroup = new THREE.Group(); // กลุ่มโมเดลของโลก
earthGroup.rotation.z = -23.4 * Math.PI / 180; // ตั้งค่าการเอียงของโลก (23.4 องศา)
scene.add(earthGroup); // เพิ่มกลุ่มโมเดลเข้าในฉาก
new OrbitControls(camera, renderer.domElement); // เปิดใช้ OrbitControls สำหรับกล้อง

const detail = 12; // กำหนดรายละเอียดของโมเดล icosahedron
const loader = new THREE.TextureLoader(); // สร้างตัวโหลด texture
const geometry = new THREE.IcosahedronGeometry(1, detail); // สร้างโมเดลพื้นฐานแบบ icosahedron

// สร้างโมเดลพระอาทิตย์
const sunMaterial = new THREE.MeshBasicMaterial({
  map: loader.load("./textures/sunmap.jpg"), // โหลด texture สำหรับพระอาทิตย์
});
const sunMesh = new THREE.Mesh(geometry, sunMaterial); // สร้างโมเดลพระอาทิตย์จาก geometry และ material
scene.add(sunMesh); // เพิ่มโมเดลพระอาทิตย์ในฉาก
sunMesh.position.set(0, 0, 0); // ตั้งตำแหน่งของพระอาทิตย์ในฉาก
sunMesh.scale.set(5, 5, 5); // ขยายขนาดโมเดลพระอาทิตย์ให้ใหญ่ขึ้น (3 เท่าจากขนาดเดิม)

// สร้าง PointLight สำหรับพระอาทิตย์
const sunLight = new THREE.PointLight(0xffffff, 60.0, 10000); // สร้างแสงแบบ PointLight ที่ปล่อยแสงออกมาจากพระอาทิตย์
sunLight.position.set(0, 0, 0); // ตั้งตำแหน่งของแสงให้ตรงกับโมเดลพระอาทิตย์
scene.add(sunLight); // เพิ่มแสงลงในฉาก

// เพิ่มเอฟเฟกต์ Lensflare ให้กับพระอาทิตย์
const textureLoader = new THREE.TextureLoader(); // สร้างตัวโหลด texture สำหรับ lensflare
const flareTexture = textureLoader.load('./textures/lensflare0.jpg'); // โหลดเท็กซ์เจอร์ของ lensflare

const lensflare = new Lensflare(); // สร้าง Lensflare object
lensflare.addElement(new LensflareElement(flareTexture, 1000, 0)); // เพิ่ม Lensflare ลงในแสง
sunLight.add(lensflare); // เพิ่ม Lensflare ลงในแสงของพระอาทิตย์

// สร้างโมเดลโลก (Earth Model)
const earthMaterial = new THREE.MeshPhongMaterial({
  map: loader.load("./textures/earthmap.jpg"), // โหลด texture ของโลก
});
const earthMesh = new THREE.Mesh(geometry, earthMaterial); // สร้างโมเดลโลกจาก geometry และ material
earthMesh.scale.set(1.5, 1.5, 1.5); // ขยายขนาดโมเดลโลกให้ใหญ่ขึ้น (1.5 เท่าจากขนาดเดิม)
earthGroup.add(earthMesh); // เพิ่มโมเดลโลกลงในกลุ่มโมเดลของโลก

// เพิ่มฉากดวงดาวในพื้นหลัง
const stars = getStarfield({ numStars: 2000 }); // สร้างฉากดวงดาวโดยใช้ฟังก์ชัน getStarfield
scene.add(stars); // เพิ่มดวงดาวในฉาก

// ฟังก์ชันการ animate ฉาก
function animate() {
  requestAnimationFrame(animate); // เรียกฟังก์ชัน animate ซ้ำอย่างต่อเนื่อง

  earthMesh.rotation.y += 0.002; // หมุนโมเดลโลก
  sunMesh.rotation.y += 0.001; // หมุนโมเดลพระอาทิตย์
  stars.rotation.y -= 0.0002; // หมุนฉากดวงดาวเล็กน้อย

  renderer.render(scene, camera); // เรนเดอร์ฉากใหม่ในทุกเฟรม
}

animate(); // เริ่มต้นการ animate

// ฟังก์ชันจัดการการเปลี่ยนขนาดหน้าต่าง
function handleWindowResize() {
  camera.aspect = window.innerWidth / window.innerHeight; // ปรับอัตราส่วนกล้องตามขนาดหน้าต่าง
  camera.updateProjectionMatrix(); // อัปเดตโปรเจคชันของกล้อง
  renderer.setSize(window.innerWidth, window.innerHeight); // ปรับขนาด renderer ให้ตรงกับขนาดหน้าต่าง
}
window.addEventListener('resize', handleWindowResize, false); // ตั้งค่าให้เรียกฟังก์ชันเมื่อขนาดหน้าต่างเปลี่ยนแปลง



// สร้าง geometry สำหรับ Aura (ทรงกลมรอบพระอาทิตย์)
const auraGeometry = new THREE.IcosahedronGeometry(5.021, detail); // สร้างโมเดลที่ใหญ่กว่าพระอาทิตย์เล็กน้อย

// สร้างวัสดุสำหรับ Aura ด้วยการใช้ ShaderMaterial เพื่อสร้างแสงเรืองรอบโมเดล
const auraMaterial = new THREE.ShaderMaterial({
  uniforms: {
    "c": { type: "f", value: 1.0 },
    "p": { type: "f", value: 2.0 },
    glowColor: { type: "c", value: new THREE.Color(0xffaa00) }, // สีของ aura (อาจใช้สีเหลืองหรือส้ม)
    viewVector: { type: "v3", value: camera.position }
  },
  vertexShader: `
    varying vec3 vNormal;
    varying vec3 vPositionNormal;
    void main() {
      vNormal = normalize(normalMatrix * normal);
      vPositionNormal = normalize((modelViewMatrix * vec4(position, 1.0)).xyz);
      gl_Position = projectionMatrix * modelViewMatrix * vec4(position, 1.0);
    }
  `,
  fragmentShader: `
    uniform vec3 glowColor;
    uniform float c;
    uniform float p;
    varying vec3 vNormal;
    varying vec3 vPositionNormal;
    void main() {
      float intensity = pow(c - dot(vNormal, vPositionNormal), p);
      gl_FragColor = vec4(glowColor * intensity, 1.0);
    }
  `,
  side: THREE.BackSide, // ทำให้แสงเรืองจากด้านในของทรงกลม
  blending: THREE.AdditiveBlending, // ทำให้แสงรวมเข้ากับสภาพแสงโดยรอบ
  transparent: true // วัสดุโปร่งใส
});

// สร้าง Mesh สำหรับ Aura
const auraMesh = new THREE.Mesh(auraGeometry, auraMaterial);
auraMesh.position.set(0, 0, 0); // ตั้งตำแหน่งให้ตรงกับพระอาทิตย์
scene.add(auraMesh); // เพิ่ม Aura ลงในฉาก
