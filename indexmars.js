import * as THREE from "three";
import { OrbitControls } from 'jsm/controls/OrbitControls.js';

import getStarfield from "./src/getStarfieldX2.js";
import { getFresnelMat } from "./src/getFresnelMatX2.js";
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
earthGroup.rotation.z = -25.19 * Math.PI / 180;
scene.add(earthGroup);
new OrbitControls(camera, renderer.domElement);

const detail = 12;
const loader = new THREE.TextureLoader();
const geometry = new THREE.IcosahedronGeometry(1, detail);
const material = new THREE.MeshPhongMaterial({
  map: loader.load("./textures/marsmap1k.jpg"),
  specularMap: loader.load("./textures/02_earthspec1k.jpg"),
  bumpMap: loader.load("./textures/marsbump1k.jpg"),
  bumpScale: 0.04,
});
const earthMesh = new THREE.Mesh(geometry, material);
earthGroup.add(earthMesh);

const lightsMat = new THREE.MeshBasicMaterial({
  map: loader.load("./textures/mars_1k_topo.jpg"),
  opacity: 0.1,
  blending: THREE.AdditiveBlending,
});
const lightsMesh = new THREE.Mesh(geometry, lightsMat);
earthGroup.add(lightsMesh);

const cloudsMat = new THREE.MeshStandardMaterial({
  map: loader.load("./textures/mars_1k_color.jpg"),
  transparent: true,
  opacity: 0.8,
  blending: THREE.AdditiveBlending,
  alphaMap: loader.load('./textures/.jpg'),
});
const cloudsMesh = new THREE.Mesh(geometry, cloudsMat);
cloudsMesh.scale.setScalar(1.003);
earthGroup.add(cloudsMesh);

const fresnelMat = getFresnelMat({ rimHex: 0xe1dfdf }); // เปลี่ยนขอบเป็นสีส้ม
const glowMesh = new THREE.Mesh(geometry, fresnelMat);
glowMesh.scale.setScalar(1.01);
earthGroup.add(glowMesh);

const stars = getStarfield({ numStars: 2000 });
scene.add(stars);

const sunLight = new THREE.DirectionalLight(0xffffff, 5.0);
sunLight.position.set(-2, 0.5, 1.5);
scene.add(sunLight);

// เพิ่มส่วนของ Phobos และ Deimos

const textureLoader = new THREE.TextureLoader();
const bufferLoader = new THREE.BufferGeometryLoader(); // โหลด BufferGeometryLoader

// โหลดโมเดล Phobos
const phobosBumpMap = textureLoader.load('./textures/phobosbump.jpg');
bufferLoader.load('./phobos/phobos.obj.bin', function (geometry) {
  const material = new THREE.MeshPhongMaterial({
    color: 0xaaaaaa,
    bumpMap: phobosBumpMap,
    bumpScale: 0.05,
  });
  const phobosMesh = new THREE.Mesh(geometry, material);
  phobosMesh.scale.set(0.05, 0.05, 0.05);
  earthGroup.add(phobosMesh);

  // ตั้งวงโคจรของ Phobos
  phobosMesh.position.set(1.5, 0, 0);
});

// โหลดโมเดล Deimos
const deimosBumpMap = textureLoader.load('./textures/deimosbump.jpg');
bufferLoader.load('./deimos.obj.bin', function (geometry) {
  const material = new THREE.MeshPhongMaterial({
    color: 0xaaaaaa,
    bumpMap: deimosBumpMap,
    bumpScale: 0.05,
  });
  const deimosMesh = new THREE.Mesh(geometry, material);
  deimosMesh.scale.set(0.05, 0.05, 0.05);
  earthGroup.add(deimosMesh);

  // ตั้งวงโคจรของ Deimos
  deimosMesh.position.set(2.5, 0, 0);
});

// สร้างการหมุนของกลุ่ม
function animate() {
  requestAnimationFrame(animate);

  earthMesh.rotation.y += 0.002;
  lightsMesh.rotation.y += 0.002;
  cloudsMesh.rotation.y += 0.0023;
  glowMesh.rotation.y += 0.002;
  
  stars.rotation.y -= 0.0002;
  earthGroup.rotation.y += 0.001; // เพิ่มการหมุนให้กับ Phobos และ Deimos
  
  renderer.render(scene, camera);
}

animate();

function handleWindowResize() {
  camera.aspect = window.innerWidth / window.innerHeight;
  camera.updateProjectionMatrix();
  renderer.setSize(window.innerWidth, window.innerHeight);
}
window.addEventListener('resize', handleWindowResize, false);
