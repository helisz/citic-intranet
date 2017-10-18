<?php

function abcfslc_cbo_yn() {
    return array('Y' => abcfslc_txta(5),
                'N'  => abcfslc_txta(6)
        );
}
function abcfslc_cbo_delimiter() {
    return array(',' => abcfslc_txta(38),
                '|'  => abcfslc_txta(39),
                'tab'  => abcfslc_txta(40),
                ';'  => abcfslc_txta(41)
        );
}

function abcfslc_cbo_enclosure() {
    return array('N' => abcfslc_txta(73),
                'Q'  => abcfslc_txta(71)
        );
}

function abcfslc_cbo_encoding() {
    return array('UTF-16LE'  => 'UTF-16LE &nbsp;&nbsp;' . abcfslc_txta(87),
        'EI'  => 'UTF-8 &nbsp;&nbsp;' .  abcfslc_txta(52) . ' - ' . abcfslc_txta(46)
    );
}

function abcfslc_cbo_encoding_ALL() {
    return array('UTF-16LE'  => 'UTF-16LE ' . abcfslc_txta(87),
        'UTF-8'  => 'UTF-8',
        'UTF-8_BOM'  => 'UTF-8 BOM',
        'EI'  => abcfslc_txta(52) . ' - ' . abcfslc_txta(46)
    );
}

function abcfslc_cbo_img_url() {
    return array('U'  => abcfslc_txta(84),
        'F'  => abcfslc_txta(13)
    );
}