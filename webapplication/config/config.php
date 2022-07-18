<?php
// main Paths
const ASSETS_PATH = '../assets/';
const CONTROLLER_PATH = '../controller/';
const MODELS_PATH = '../modelsTests/';
const DOC_PATH = '../docs/';

// sub Paths
const JAVA_SCRIPT_PATH = ASSETS_PATH . 'js/';
const CSS_PATH = ASSETS_PATH . 'css/';

// Images
const IMAGE_PATH = ASSETS_PATH . 'images/';
const PAGE_IMAGE_PATH = IMAGE_PATH . 'pageImages/';
const DOCUMENTATION_IMAGE_PATH = IMAGE_PATH . 'documentation/';
const PICTURE_RASTER_PATH = IMAGE_PATH . 'pictureRaster/';
const ERROR_GIF_PATH = IMAGE_PATH . 'errorGif/';

const INSERT = 'insert';
const UPDATE = 'update';

const NUTRIENTS_ELEMENT_TO_NAME = [
    'P' => 'Phosphor',
    'K' => 'Kalium',
    'Ca' => 'Calcium',
    'Mg' => 'Magnesium',
    'Na' => 'Natrium',
    'S' => 'Schwefel',
    'Fe' => 'Eisen',
    'Mn' => 'Mangan',
    'Cu' => 'Kupfer',
    'Zn' => 'Zink',
    'B' => 'Bor',
    'Mo' => 'Molybdän',
    'Cl' => 'Chlor',
    'Si' => 'Silicium',
    'C' => 'Kohlenstoff',
    'N' => 'Stickstoff'
];

const NUTRIENTS_NAME_TO_ELEMENT = [
    'Phosphor' => 'P',
    'Kalium' => 'K',
    'Calcium' => 'Ca',
    'Magnesium' => 'Mg',
    'Natrium' => 'Na',
    'Schwefel' => 'S',
    'Eisen' => 'Fe',
    'Mangan' => 'Mn',
    'Kupfer' => 'Cu',
    'Zink' => 'Zn',
    'Bor' => 'B',
    'Molybdän' => 'Mo',
    'Chlor' => 'Cl',
    'Silicium' => 'Si',
    'Kohlenstoff' => 'C',
    'Stickstoff' => 'N'
];

const NUTRIENTS_NAME_TO_ID = [
    'Phosphor' => 0,
    'Kalium' => 1,
    'Calcium' => 2,
    'Magnesium' => 3,
    'Natrium' => 4,
    'Schwefel' => 5,
    'Eisen' => 6,
    'Mangan' => 7,
    'Kupfer' => 8,
    'Zink' => 9,
    'Bor' => 10,
    'Molybdän' => 11,
    'Chlor' => 12,
    'Silicium' => 13,
    'Kohlenstoff' => 14,
    'Stickstoff' => 15
];

const NUTRIENTS_ELEMENT_TO_ID = [
    'P' => 0,
    'K' => 1,
    'Ca' => 2,
    'Mg' => 3,
    'Na' => 4,
    'S' => 5,
    'Fe' => 6,
    'Mn' => 7,
    'Cu' => 8,
    'Zn' => 9,
    'B' => 10,
    'Mo' => 11,
    'Cl' => 12,
    'Si' => 13,
    'C' => 14,
    'N' => 15
];

const NUTRIENTS = [
    'Phosphor',
    'Kalium',
    'Calcium',
    'Magnesium',
    'Natrium',
    'Schwefel',
    'Eisen',
    'Mangan',
    'Kupfer',
    'Zink',
    'Bor',
    'Molybdän',
    'Chlor',
    'Silicium',
    'Kohlenstoff',
    'Stickstoff'
];