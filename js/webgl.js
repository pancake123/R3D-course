var container,
	camera,
	scene,
	renderer,
	floorMesh,
	cubeMesh,
	phi = 0;

var init = function() {

	container = $("<div>", {
		id: "container"
	}).appendTo("body");

	camera = new THREE.PerspectiveCamera(45, window.innerWidth / window.innerHeight,
		1, 10000
	);
	camera.position.z = 250;
	camera.position.y = 0;

	scene = new THREE.Scene();

	floorMesh = new THREE.Mesh(new THREE.BoxGeometry(600, 600, 5),
		new THREE.MeshBasicMaterial({
			color: 0x248C0F,
			opacity: 0.9
		}));
	floorMesh.position.y = 500;
	floorMesh.rotation.x = 90 * Math.PI / 180;
	scene.add(floorMesh);

	var cube = new THREE.BoxGeometry(50, 50, 50, 1, 1, 1);
	cubeMesh = new THREE.Mesh(cube, new THREE.MeshFaceMaterial([
		//делаем каждую сторону своего цвета
		new THREE.MeshBasicMaterial( { color: 0xE01B4C }), // правая сторона
		new THREE.MeshBasicMaterial( { color: 0x34609E }), // левая сторона
		new THREE.MeshBasicMaterial( { color: 0x7CAD18 }), //верх
		new THREE.MeshBasicMaterial( { color: 0x00EDB2 }), // низ
		new THREE.MeshBasicMaterial( { color: 0xED7700 }), // лицевая сторона
		new THREE.MeshBasicMaterial( { color: 0xB5B1AE }) // задняя сторона
	]));
	cubeMesh.position.y = 500;
	scene.add(cubeMesh);

	renderer = new THREE.WebGLRenderer();
	renderer.setSize(window.innerWidth, window.innerHeight);
	container.append(renderer.domElement);
};

var render = function() {
	//вращаем куб по всем трем осям (переменная мэша куба доступна глобально)
	cubeMesh.rotation.x += 0.5 * Math.PI / 90;
	cubeMesh.rotation.y += 1.0 * Math.PI / 90;
	cubeMesh.rotation.z += 1.5 * Math.PI / 90;
	//двигаем куб по кругу, изменяя координаты его позиции по осям x и y
	cubeMesh.position.x = Math.sin( phi ) * 50;
	cubeMesh.position.y = Math.cos( phi ) * 50;
	//итерируем глобальную переменную
	phi+= 0.05;
	//рендерим
	renderer.render(scene, camera);
};

var timer = function() {
	render();
	setTimeout(function() {
		timer();
	}, 10);
};

$(document).ready(function() {
	init();
	timer();
});