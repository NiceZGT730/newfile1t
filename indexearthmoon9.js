import * as THREE from "three";
import { OrbitControls } from 'jsm/controls/OrbitControls.js';

import getStarfield from "./src/getStarfieldX99.js";
import { getFresnelMat } from "./src/getFresnelMatX99.js";

const w = 800;
const h = 460;
const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(75, w / h, 0.1, 1000);
camera.position.z = 5;
const renderer = new THREE.WebGLRenderer({ antialias: true });
renderer.setSize(w, h);
document.body.appendChild(renderer.domElement);

// THREE.ColorManagement.enabled = true;
renderer.toneMapping = THREE.ACESFilmicToneMapping;
renderer.outputColorSpace = THREE.LinearSRGBColorSpace;

const earthGroup = new THREE.Group();
earthGroup.rotation.z = -23.4 * Math.PI / 180;  // เอียงโลกตามแกน
scene.add(earthGroup);
new OrbitControls(camera, renderer.domElement);

const detail = 8;
const loader = new THREE.TextureLoader();
const geometry = new THREE.IcosahedronGeometry(1, detail);
const material = new THREE.MeshPhongMaterial({
  map: loader.load("./textures/00_earthmap1k.jpg"),
  specularMap: loader.load("./textures/02_earthspec1k.jpg"),
  bumpMap: loader.load("./textures/01_earthbump1k.jpg"),
  bumpScale: 0.04,
});
const earthMesh = new THREE.Mesh(geometry, material);
earthGroup.add(earthMesh);

const lightsMat = new THREE.MeshBasicMaterial({
  map: loader.load("./textures/03_earthlights1k.jpg"),
  blending: THREE.AdditiveBlending,
});
const lightsMesh = new THREE.Mesh(geometry, lightsMat);
earthGroup.add(lightsMesh);

const cloudsMat = new THREE.MeshStandardMaterial({
  map: loader.load("./textures/04_earthcloudmap.jpg"),
  transparent: true,
  opacity: 0.8,
  blending: THREE.AdditiveBlending,
  alphaMap: loader.load('./textures/05_earthcloudmaptrans.jpg'),
});
const cloudsMesh = new THREE.Mesh(geometry, cloudsMat);
cloudsMesh.scale.setScalar(1.003);
earthGroup.add(cloudsMesh);

const fresnelMat = getFresnelMat();
const glowMesh = new THREE.Mesh(geometry, fresnelMat);
glowMesh.scale.setScalar(1.01);
earthGroup.add(glowMesh);

const stars = getStarfield({ numStars: 200 });
scene.add(stars);

const sunLight = new THREE.DirectionalLight(0xffffff, 2.0);
sunLight.position.set(-2, 0.5, 1.5);
scene.add(sunLight);

// สร้างกลุ่มใหม่สำหรับดวงจันทร์ (moonGroup)
const moonGroup = new THREE.Group();
scene.add(moonGroup);

// โหลดแผนที่และแผนที่การขรุขระของดวงจันทร์
const moonTexture = loader.load('./textures/11_moonmap4k.jpg');
const moonBumpMap = loader.load('./textures/12_moonbump4k.jpg');

// สร้าง Geometry และ Material สำหรับดวงจันทร์
const moonGeometry = new THREE.SphereGeometry(0.27, 32, 32); // ขนาดเล็กกว่าโลก
const moonMaterial = new THREE.MeshPhongMaterial({
  map: moonTexture,
  bumpMap: moonBumpMap,
  bumpScale: 0.02,
});

// สร้าง Mesh สำหรับดวงจันทร์
const moonMesh = new THREE.Mesh(moonGeometry, moonMaterial);

// ตั้งตำแหน่งของดวงจันทร์ห่างจากโลก (แกน X)
moonMesh.position.set(2.5, 0, 0);

// เพิ่มดวงจันทร์เข้าไปในกลุ่ม moonGroup
moonGroup.add(moonMesh);

// เพิ่มกลุ่ม moonGroup เข้ากับโลก (earthGroup)
scene.add(moonGroup);

// ฟังก์ชันแอนิเมชัน
function animate() {
  requestAnimationFrame(animate);

  // หมุนโลกและองค์ประกอบของโลก
  earthMesh.rotation.y += 0.002;
  lightsMesh.rotation.y += 0.002;
  cloudsMesh.rotation.y += 0.0023;
  glowMesh.rotation.y += 0.002;

  // หมุนดวงจันทร์รอบตัวเอง
  moonMesh.rotation.y += 0.001;

  // หมุนกลุ่ม moonGroup รอบโลก (โคจรรอบโลก)
  moonGroup.rotation.y += 0.001;

  // หมุนดวงดาว (พื้นหลัง)
  stars.rotation.y -= 0.0002;

  renderer.render(scene, camera);
}

animate();

// ปรับการตอบสนองเมื่อขนาดหน้าต่างเปลี่ยน
function handleWindowResize() {
  camera.aspect = window.innerWidth / window.innerHeight;
  camera.updateProjectionMatrix();
  renderer.setSize(window.innerWidth, window.innerHeight);
}
window.addEventListener('resize', handleWindowResize, false);
document.getElementById('renderer-container').appendChild(renderer.domElement);

