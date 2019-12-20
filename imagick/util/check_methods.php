<?php

$cache = false;

$urls = [
    "drawing_wand" => "https://imagemagick.org/api/drawing-wand.php",
    "pixel_iterator" => "https://imagemagick.org/api/pixel-iterator.php",
    "pixel_wand" => "https://imagemagick.org/api/pixel-wand.php",
    "wand_view" => "https://imagemagick.org/api/wand-view.php",
    "magick_image" => "https://imagemagick.org/api/magick-image.php",
    "magick_property" => "https://imagemagick.org/api/magick-property.php",
    "magick_wand" => "https://imagemagick.org/api/magick-wand.php",
];

function getFileName($type)
{
    return __DIR__ . "/found_" . $type . "_methods.txt";
}

$methods = [];

if ($cache === false) {

    foreach ($urls as $type => $url) {
        $html = file_get_contents($url);

        $pattern = '#<a href=".+" id="(.+)">\1</a>#iu';
        $count = preg_match_all($pattern, $html, $matches);

        foreach ($matches[1] as $matchDetail) {
            $methods[$matchDetail] = false;
        }

        file_put_contents(getFileName($type), implode("\n", $matches[1]));
    }
}
else {
    foreach ($urls as $type => $url) {
        $filename = getFileName($type);
        $lines = file($filename);

        foreach ($lines as $line) {
            $line = trim($line);
            if (strlen($line) > 0) {
                $methods[$line] = false;
            }
        }
    }

}



$tests = [
	"draw",
	"pixel",
	"wand"
];

$unsupportedMethods = [
	"MagickSetImageEndian", // nope.
	"MagickGetImageEndian", //nope, nope, nope
	"MagickDestroyImage", //this shouldn't be needed. It's covered by clear?
	"MagickGetImageFuzz", // I'm not aware of any operations that use the built in fuzz
	"MagickSetImageFuzz", // I'm not aware of any operations that use the built in fuzz
	"MagickGetImageChannelDistortions", //Don't understand
	"MagickGetImageChannelFeatures", //Don't understand
	"MagickConstituteImage", //duplicate functionality.
	"MagickCompositeLayers", //duplicate functionality.

	//Pixel
	"PixelGetException", // not a user function
	"NewPixelWands", // Probably not needed.
	"IsDrawingWand", //Not needed
	"ClonePixelWands", // Hopefully not needed
	"DestroyPixelWands", //Shouldn't be needed?
	"PixelGetMagickColor", // We don't expose MagickPixelPacket currently
	"PixelSetMagickColor", // We don't expose MagickPixelPacket currently
	"ClonePixelWands", //Shouldn't be needed.
	"DestroyPixelWands", //shouldn't be needed.
	"PixelGetColorAsNormalizedString", //stahp
	"PixelGetExceptionType", // This should be everywhere?
	"PixelGetQuantumColor", //pixelpackets are not exposed.
	"PixelSetQuantumColor", //pixelpackets are not exposed.

	// Draw
	"DrawAllocateWand", // not a user function
	"IsDrawingWand", //Not needed


    // TODO - add these when someone asks for them or they are required
    "SetWandViewIterator",
    "TransferWandViewIterator",
    "UpdateWandViewIterator",
    "ClonePixelIterator",
    "CloneWandView",
    "DestroyWandView",
    "GetWandViewException",
    "GetWandViewExtent",
    "GetWandViewIterator",
    "GetWandViewPixels",
    "GetWandViewWand",
    "DrawCloneExceptionInfo",
    "DrawGetExceptionType",




    // TODO - these should not be needed in PHP land
    "IsMagickWand",
    "IsMagickWandInstantiated",
    "IsPixelIterator",
    "IsWandView",





];


//$methods = [];
//
//foreach ($tests as $test) {
//	$lines = file($test."_methods.txt");
//	if ($lines === false) {
//		echo "Couldn't read file for $test \n";
//		exit(-1);
//	}
//
//	foreach ($lines as $line) {
//		$methods[trim($line)] = false;
//	}
//}



$files = glob("../*.c");

$contents = [];

$excludeSourceFiles = [
	"#.*shim.s*#"
];

foreach ($files as $file) {
	//Don't look in some source files.
	foreach ($excludeSourceFiles as $excludeSourceFile) {
		if (preg_match($excludeSourceFile, $file) !== 0) {
			echo "Excluding file $file\n";
			continue 2;
		}
	}

	echo "Check file $file \n";

	$contents = file_get_contents($file);

	if ($contents == false) {
		echo "Failed to read $file\n";
		exit(0);
	}

	foreach ($methods as $name => $found) {
		if ($found == true) {
			continue;
		}

		$position = strpos($contents, $name);

		if ($position !== false) {
			$methods[$name] = true;
		}
	}
}

//exit(0);
ksort($methods);
foreach ($methods as $name => $found) {
	if (in_array($name, $unsupportedMethods) == true) {
		continue;
	}

	if ($found == false) {
		echo "Missing: $name\n";
	}
}









