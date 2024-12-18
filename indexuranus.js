import * as THREE from "three";
import { OrbitControls } from 'jsm/controls/OrbitControls.js';

import getStarfield from "./src/getStarfieldX7.js";
import { getFresnelMat } from "./src/getFresnelMatX7.js";

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

const uranusGroup = new THREE.Group();
uranusGroup.rotation.z = 98 * Math.PI / 180; // เอียงตามองศาของดาวยูเรนัส
scene.add(uranusGroup);
new OrbitControls(camera, renderer.domElement);

const detail = 12;
const loader = new THREE.TextureLoader();
const geometry = new THREE.IcosahedronGeometry(1, detail);
const material = new THREE.MeshPhongMaterial({
  map: loader.load("./textures/uranusmap.jpg"),
  specularMap: loader.load("./textures/.jpg"),
  bumpMap: loader.load("./textures/.jpg"),
  bumpScale: 0.04,
});

const uranusMesh = new THREE.Mesh(geometry, material);
uranusGroup.add(uranusMesh);

const lightsMat = new THREE.MeshBasicMaterial({
  map: loader.load("./textures/.jpg"),
  blending: THREE.AdditiveBlending,
});
const lightsMesh = new THREE.Mesh(geometry, lightsMat);
uranusGroup.add(lightsMesh);

const cloudsMat = new THREE.MeshStandardMaterial({
  map: loader.load("./textures/04_earthcloudmap.jpg"),
  transparent: true,
  opacity: 1,
  blending: THREE.AdditiveBlending,
  alphaMap: loader.load('./textures/05_earthcloudmaptrans.png'),
});
const cloudsMesh = new THREE.Mesh(geometry, cloudsMat);
cloudsMesh.scale.setScalar(1.003);
uranusGroup.add(cloudsMesh);

const fresnelMat = getFresnelMat();
const glowMesh = new THREE.Mesh(geometry, fresnelMat);
glowMesh.scale.setScalar(1.01);
uranusGroup.add(glowMesh);

// โหลด Texture วงแหวน
const ringColorTexture = loader.load('./textures/small_ring_tex.png');
const ringPatternTexture = loader.load('./textures/small_ring_tex.png');
const ringPatternTexture2 = loader.load('./textures/small_ring_tex2.png');

// สร้างวงแหวนวงแรก
const ringGeometry = new THREE.RingGeometry(1.8, 3.0, 640); // ขนาดวงแหวน ปรับตามต้องการ
const ringMaterial = new THREE.MeshPhongMaterial({
  map: ringColorTexture, // สีของวงแหวน
  alphaMap: ringPatternTexture, // ลวดลายของวงแหวน
  transparent: true,
  color: 0xbfac00, // สีพื้นฐานเข้มขึ้น
  side: THREE.DoubleSide, // แสดงวงแหวนทั้งสองด้าน
});
const ringMesh = new THREE.Mesh(ringGeometry, ringMaterial);
ringMesh.rotation.x = Math.PI / 2; // หมุนวงแหวนให้ขนานกับแกน
uranusGroup.add(ringMesh);

// สร้างวงแหวนวงที่สอง
const ringGeometry2 = new THREE.RingGeometry(1.8, 2.0, 640); // ขนาดวงแหวนที่ต่างออกไป
const ringMaterial2 = new THREE.MeshPhongMaterial({
  map: ringColorTexture, // สีของวงแหวน
  alphaMap: ringPatternTexture2, // ลวดลายของวงแหวน
  transparent: true,
  color: 0xbfac00, // สีพื้นฐานเข้มขึ้น
  side: THREE.DoubleSide, // แสดงวงแหวนทั้งสองด้าน
});
const ringMesh2 = new THREE.Mesh(ringGeometry2, ringMaterial2);
ringMesh2.rotation.x = Math.PI / 2; // หมุนวงแหวนให้ขนานกับแกน
uranusGroup.add(ringMesh2);

// เพิ่มแสง
const light = new THREE.DirectionalLight(0xffffff, 1);
light.position.set(1, 1, 2);
scene.add(light);

const ambientLight = new THREE.AmbientLight(0x079be0);
scene.add(ambientLight);

const stars = getStarfield({ numStars: 2000 });
scene.add(stars);

const sunLight = new THREE.DirectionalLight(0xffffff, 2.0);
sunLight.position.set(-2, 0.5, 1.5);
scene.add(sunLight);

function animate() {
  requestAnimationFrame(animate);

  uranusMesh.rotation.y += 0.002;
  lightsMesh.rotation.y += 0.002;
  cloudsMesh.rotation.y += 0.0023;
  glowMesh.rotation.y += 0.002;
  ringMesh.rotation.z += 0.001; // หมุนวงแหวน
  ringMesh2.rotation.z += 0.001; // หมุนวงแหวน
  stars.rotation.y -= 0.0002;

  renderer.render(scene, camera);
}

animate();
