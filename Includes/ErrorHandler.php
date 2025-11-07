<?php
class ErrorHandler {
    public static function handleException(Throwable $exception): void {
        // Log the error
        error_log("Uncaught Exception: " . $exception->getMessage() . " in " . $exception->getFile() . ":" . $exception->getLine());
        
        // Set HTTP response code
        http_response_code(500);
        
        // Return JSON response for API requests
        if (self::isApiRequest()) {
            header('Content-Type: application/json');
            echo json_encode([
                'error' => [
                    'message' => 'An error occurred',
                    'code' => $exception->getCode(),
                ]
            ]);
            return;
        }
        
        // Show error page for web requests
        if (file_exists(__DIR__ . '/../views/errors/500.php')) {
            include __DIR__ . '/../views/errors/500.php';
        } else {
            echo "<h1>An error occurred</h1>";
            echo "<p>Please try again later.</p>";
            if (ini_get('display_errors')) {
                echo "<pre>" . htmlspecialchars($exception->getMessage()) . "</pre>";
            }
        }
    }
    
    public static function handleError(
        int $errno,
        string $errstr,
        string $errfile = null,
        int $errline = null
    ): bool {
        // Don't execute PHP internal error handler
        if (!(error_reporting() & $errno)) {
            return false;
        }
        
        $errorMessage = "Error [{$errno}] {$errstr} in {$errfile} on line {$errline}";
        error_log($errorMessage);
        
        // Convert errors to ErrorException
        throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
    }
    
    public static function handleShutdown(): void {
        $error = error_get_last();
        if ($error !== null && in_array($error['type'], [E_ERROR, E_CORE_ERROR, E_COMPILE_ERROR, E_USER_ERROR])) {
            error_log("Fatal error: {$error['message']} in {$error['file']} on line {$error['line']}");
            
            if (!headers_sent()) {
                http_response_code(500);
            }
            
            if (self::isApiRequest()) {
                header('Content-Type: application/json');
                echo json_encode([
                    'error' => [
                        'message' => 'A fatal error occurred',
                        'code' => 500,
                    ]
                ]);
            } elseif (file_exists(__DIR__ . '/../views/errors/500.php')) {
                include __DIR__ . '/../views/errors/500.php';
            } else {
                echo "<h1>A fatal error occurred</h1>";
                if (ini_get('display_errors')) {
                    echo "<pre>" . htmlspecialchars($error['message']) . "</pre>";
                }
            }
        }
    }
    
    private static function isApiRequest(): bool {
        return !empty($_SERVER['HTTP_ACCEPT']) && 
               strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false;
    }
}

// Set error handlers
set_exception_handler([ErrorHandler::class, 'handleException']);
set_error_handler([ErrorHandler::class, 'handleError']);
register_shutdown_function([ErrorHandler::class, 'handleShutdown']);
