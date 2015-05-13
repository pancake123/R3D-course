#include "Define.h"
#include "Model.h"
#include "Point.h"
#include "Vertex.h"
#include "Camera.h"

#include "glfw/glfw3.h"
#include "math/glm.hpp"
#include "math/gtc/matrix_transform.hpp"

#include <iostream>

#define WIDTH 1024
#define HEIGHT 768

Camera camera;
Model car;
Model chair;

GLvoid frustum(GLfloat left, GLfloat right, GLfloat bottom, GLfloat top, GLfloat near, GLfloat far) {
	
	glm::mat4x4 matrix(
		(2 * near) / (right - left), 0, (right + left) / (right - left), 0,
		0, (2 * near) / (top - bottom), (top + bottom) / (top - bottom), 0,
		0, 0, -(far + near) / (far - near), -(2 * far + near) / (far - near),
		0, 0, -1, 0
	);

	glLoadMatrixf((const GLfloat*)&glm::transpose(matrix));
}

GLvoid perspective(GLfloat fov, GLfloat aspectRatio, GLfloat near, GLfloat far) {

	GLfloat y = near * tanf(fov * M_PI / 360.0),
		x = y * aspectRatio;

	glFrustum(-x, x, -y, y, near, far);
}

GLvoid reverse(GLfloat fov, GLfloat aspectRatio, GLfloat near, GLfloat far) {

	perspective(fov, aspectRatio, far, near);
	glScalef(-1, 1, 1);
	glTranslatef(0, 0, -(far - near) / 2);
	glRotatef(180.0, 0, 1, 0);
	glTranslatef(0, 0, (far - near) / 2);
}

void render() {

	GLfloat native[16];

	glMatrixMode(GL_MODELVIEW);
	glLoadIdentity();
	glMatrixMode(GL_PROJECTION);
	glLoadIdentity();
	reverse(45, 4.0 / 3.0, 1, 1000);

	camera.keyboard(10);
	camera.lookAt();

	car.render();
}

int main(int argc, char** argv) {

	//glm::mat4x4 matrix(
	//	2.40, 0, 0, 0,
	//	0, 4.0, 0, 0,
	//	0, 0, -1.0, -1.0,
	//	0, 0, -8.02, 0
	//);

	//glm::mat4x4 result = glm::inverse(matrix);

	//for (int i = 0; i < 4; i++) {
	//	glm::vec4 vec = result[i];
	//	for (int j = 0; j < 4; j++) {
	//		std::cout << vec[j] << " ";
	//	}
	//	std::cout << std::endl;
	//}

	//return 0;

	if (!glfwInit()) {
		return -1;
	}

	GLFWwindow* window = glfwCreateWindow(WIDTH, HEIGHT, "Hello, World", NULL, NULL);

	if (!window) {
		glfwTerminate();
		return -1;
	}

	glfwSetWindowPos(window, 800, 100);
	glfwMakeContextCurrent(window);

	glfwSetKeyCallback(window, [] (GLFWwindow* window, int key, int code, int action, int mod) {
		if (action == GLFW_RELEASE) {
			return;
		}
		if (key == GLFW_KEY_ESCAPE) {
			glfwSetWindowShouldClose(window, GL_TRUE);
		}
		else if (key == GLFW_KEY_SPACE) {
			GLfloat matrix[16];
			glGetFloatv(GL_PROJECTION_MATRIX, matrix);
			for (int i = 0; i < 4; i++) {
				for (int j = 0; j < 4; j++) {
					printf("%.2f ", matrix[i * 4 + j]);
				}
				printf("\n");
			}
			printf("\n");
		}
	});

	glfwSetWindowRefreshCallback(window, [] (GLFWwindow* window) {
		int width, height;
		glfwGetWindowSize(window, &width, &height);
		glViewport(0, 0, width, height);
		glMatrixMode(GL_PROJECTION);
		glLoadIdentity();
		glMatrixMode(GL_MODELVIEW);
		glLoadIdentity();
		//gluPerspective(150, (float) WIDTH / HEIGHT, 1, 10000);
		float aspectRatio = (float)WIDTH / HEIGHT;
		glFrustum(-1 * aspectRatio, 1 * aspectRatio, -1, 1, 2, 2000);
	});

	glfwSetCursorPosCallback(window, [] (GLFWwindow* window, double x, double y) {
		camera.mouse(Point(int(x), -int(y)), true);
	});

	camera.create(Vertex(150, 50, 400), Vertex(0, 0, 0));

	car.load("../../static/models/moskvitch/moskvitch.obj");

	glfwWindowHint(GLFW_DEPTH_BITS, 32);
	glEnable(GL_DEPTH_TEST);

	while (!glfwWindowShouldClose(window)) {

		// Clear color and depth
		glClearColor(0, 0, 0, 0);
		glClearDepth(1.0f);

		// Clear scene
		glClear(GL_COLOR_BUFFER_BIT | GL_DEPTH_BUFFER_BIT);

		// Render scene
		render();

		// Swap buffers
		glfwSwapBuffers(window);

		// Poll for and process events
		glfwPollEvents();
	}

	glfwTerminate();
}