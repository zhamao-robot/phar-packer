<?php
/**
 * 将引入的外部php功能模块打包为phar进行调用
 */

/**
 * @param string $dir
 * @param string $name
 */
function packDir(string $dir, string $name) {
    //$metadata = ["name" => $name, "directory" => $dir, "creationDate" => time()];
    $fileName = $name . ".phar";
    if (file_exists($fileName)) {
        echo "Phar file already exists, overwriting...\n";
        @Phar::unlinkArchive($fileName);
    }
    $phar = new Phar($fileName);
    $phar->buildFromDirectory($dir);
    $phar->setStub($phar->createDefaultStub("autoloader.php", "autoloader.php"));
    $phar->stopBuffering();
    echo "Creating success!\n";
}

echo "请输入你的打包目录：";
$dir = trim(fgets(STDIN));
echo "请输入你的打包文件名（无需后缀）：";
$name = trim(fgets(STDIN));
packDir($dir, $name);
