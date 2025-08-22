<?php

use App\Exceptions\ObjectNotFoundException;

class Handler {
    public function render(): void
    {
        $this->renderable(function (ObjectNotFoundException $e, $request) {
            if (!$request->expectsJson()) {
                return response()->view('errors.user-not-found', [
                    'message' => $e->getMessage()
                ], 404);
            }

            // For API fallback
            return response()->json([
                'error' => $e->getMessage()
            ], 404);
        });
    }
}
