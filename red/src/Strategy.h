#ifndef __RED_STRATEGY__
#define __RED_STRATEGY__

#include "Define.h"

enum class Strategy: unsigned int {
	R_STRATEGY_UNKNOWN = 0x0000,
	R_STRATEGY_SINGLE_POINT = 0x0001,
	R_STRATEGY_DOUBLE_POINT = 0x0002,
	R_STRATEGY_TRIPLE_POINT = 0x0003,
	R_STRATEGY_SPHERE = 0x0004,
	R_STRATEGY_REVERSE = 0x0005,
	R_STRATEGY_LINEAR = 0x0006
};

#endif // ~__RED_STRATEGY__