import * as THREE from "three";
import { OrbitControls } from 'jsm/controls/OrbitControls.js';

import getStarfield from "./src/getStarfieldX5.js";
import { getFresnelMat } from "./src/getFresnelMatX5.js";

const w = window.innerWidth;
const h = window.innerHeight;
const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(75, w / h, 0.1, 1000);
camera.position.z = 5;
const renderer = new THREE.WebGLRenderer({ antialias: true });
renderer.setSize(w, h);
document.body.appendChild(renderer.domElement);

renderer.toneMapping = THREE.ACESFilmicToneMapping;
renderer.outputColorSpace = THREE.LinearSRGBColorSpace;

const earthGroup = new THREE.Group();
earthGroup.rotation.z = 26.7 * Math.PI / 180; // เปลี่ยนเป็นมุมเอียงของดาวเสาร์
scene.add(earthGroup);
new OrbitControls(camera, renderer.domElement);

const detail = 12;
const loader = new THREE.TextureLoader();
const geometry = new THREE.IcosahedronGeometry(1, detail);
const material = new THREE.MeshPhongMaterial({
  map: loader.load("./textures/saturnmap.jpg"),
  specularMap: loader.load("./textures/.jpg"),
  bumpMap: loader.load("./textures/.jpg"),
  bumpScale: 0.04,
});

const earthMesh = new THREE.Mesh(geometry, material);
earthGroup.add(earthMesh);

const lightsMat = new THREE.MeshBasicMaterial({
  map: loader.load("./textures/.jpg"),
  blending: THREE.AdditiveBlending,
});
const lightsMesh = new THREE.Mesh(geometry, lightsMat);
earthGroup.add(lightsMesh);

const cloudsMat = new THREE.MeshStandardMaterial({
  map: loader.load("./textures/04_earthcloudmap.jpg"),
  transparent: true,
  opacity: 1,
  blending: THREE.AdditiveBlending,
  alphaMap: loader.load('./textures/05_earthcloudmaptrans.png'),
});
const cloudsMesh = new THREE.Mesh(geometry, cloudsMat);
cloudsMesh.scale.setScalar(1.003);
earthGroup.add(cloudsMesh);

const fresnelMat = getFresnelMat();
const glowMesh = new THREE.Mesh(geometry, fresnelMat);
glowMesh.scale.setScalar(1.01);
earthGroup.add(glowMesh);

// โหลด Texture
const ringColorTexture = loader.load('./textures/big_ring_tex.png');

// ใช้ texture ที่อัปโหลด (แทนที่ saturnringpattern.gif ด้วย small_ring_tex.png)
const ringPatternTexture = loader.load('./textures/small_ring_tex.png'); // ใช้ path ของไฟล์ที่คุณอัปโหลด

// สร้างวงแหวนดาวเสาร์
const ringGeometry = new THREE.RingGeometry(1.2, 2.0, 64); // ขนาดวงแหวน ปรับตามต้องการ
const ringMaterial = new THREE.MeshPhongMaterial({
  map: ringColorTexture, // สีของวงแหวน
  alphaMap: ringPatternTexture, // ลวดลายของวงแหวน (ใช้ texture ที่อัปโหลด)
  transparent: true,
  
  color: 0xbfac00, // สีพื้นฐานเข้มขึ้น (ใช้โค้ดสี Hex)
  side: THREE.DoubleSide, // แสดงวงแหวนทั้งสองด้าน
  
});

const ringMesh = new THREE.Mesh(ringGeometry, ringMaterial);
ringMesh.rotation.x = Math.PI / 2; // หมุนวงแหวนให้ขนานกับแกน
ringMesh.position.set(0, 0, 0); // วางตำแหน่งวงแหวนที่กึ่งกลาง

// เพิ่มวงแหวนลงใน earthGroup หรือกลุ่มของดาว
earthGroup.add(ringMesh);
// เพิ่มแสง
const light = new THREE.DirectionalLight(0xffffff, 1);
light.position.set(1, 1, 2);
scene.add(light);

const ambientLight = new THREE.AmbientLight(0x404040);
scene.add(ambientLight);


earthGroup.add(ringMesh);

const stars = getStarfield({ numStars: 2000 });
scene.add(stars);

const sunLight = new THREE.DirectionalLight(0xffffff, 2.0);
sunLight.position.set(-2, 0.5, 1.5);
scene.add(sunLight);

function animate() {
  requestAnimationFrame(animate);

  earthMesh.rotation.y += 0.002;
  lightsMesh.rotation.y += 0.002;
  cloudsMesh.rotation.y += 0.0023;
  glowMesh.rotation.y += 0.002;
  ringMesh.rotation.z += 0.001; // หมุนวงแหวน
  stars.rotation.y -= 0.0002;

  renderer.render(scene, camera);
}

animate();
