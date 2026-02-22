<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $slider = App\Models\Slider::first();
    if ($slider) {
        $controller = new App\Http\Controllers\Admin\SliderController();
        $controller->destroy($slider);
        echo "Success\n";
    } else {
        echo "No slider found\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}
