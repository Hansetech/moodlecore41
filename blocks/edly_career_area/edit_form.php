<?php
require_once($CFG->dirroot . '/theme/edly/inc/course_handler/edly_course_handler.php');

class block_edly_career_area_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        global $CFG;
        $edlyFontList = include($CFG->dirroot . '/theme/edly/inc/font_handler/edly_font_select.php');

        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        // Top Title
        $mform->addElement('text', 'config_top_title', get_string('config_top_title', 'theme_edly'));
        $mform->setDefault('config_top_title', 'Over 5500+ courses available');
        $mform->setType('config_top_title', PARAM_RAW);

        // Title
        $mform->addElement('text', 'config_title', get_string('config_title', 'theme_edly'));
        $mform->setDefault('config_title', 'Get job-ready for <span>an in</span> demand career');
        $mform->setType('config_title', PARAM_RAW);

        // Content
        $mform->addElement('textarea', 'config_content', 'Bottom Title');
        $mform->setDefault('config_content', 'Break into a new field like information technology o data science. No prior experience necessary to get started. Break a new field like information technology.');
        $mform->setType('config_content', PARAM_RAW);

        // Bottom Title
        $mform->addElement('text', 'config_bottom_title', 'Bottom Title');
        $mform->setDefault('config_bottom_title', '522,8910 <span>people are learning on edly today.</span>');
        $mform->setType('config_bottom_title', PARAM_RAW);

        // Image URL
        $mform->addElement('static', 'config_image_doc', '<b><a style="color: var(--main-color)" href="https://docs.hibootstrap.com/docs/edly-moodle-theme-documentation/faqs/how-to-get-the-image-url/" target="_blank">Doc link: How to make Image URL?</a></b>'); 

        // Shape Image 1
        $mform->addElement('text', 'config_shape_img', 'Shape Image 1 URL');
        $mform->setType('config_shape_img', PARAM_TEXT);

        $funfactsnumber = 4;
        if(isset($this->block->config->funfactsnumber)){
            $funfactsnumber = $this->block->config->funfactsnumber;
        }

        $funfactsrange = array(
            1 => '1',
            2 => '2',
            3 => '3',
            4 => '4',
            5 => '5',
            6 => '6',
            7 => '7',
            8 => '8',
            9 => '9',
            10 => '10',
            11 => '11',
            12 => '12',
            13 => '13',
            14 => '14',
            15 => '15',
            16 => '16',
            17 => '17',
            18 => '18',
            19 => '19',
            20 => '20',
            21 => '21',
            22 => '22',
            23 => '23',
            24 => '24',
            25 => '25',
            26 => '26',
            27 => '27',
            28 => '28',
            29 => '29',
            30 => '30',
        );

        $mform->addElement('select', 'config_funfactsnumber', get_string('config_items', 'theme_edly'), $funfactsrange);
        $mform->setDefault('config_funfactsnumber', 4);

        for($i = 1; $i <= $funfactsnumber; $i++) {
            $mform->addElement('header', 'config_edly_item' . $i , get_string('config_item', 'theme_edly') . $i);

            $mform->addElement('text', 'config_funfacts_title' . $i, get_string('config_title', 'theme_edly', $i));
            $mform->setDefault('config_funfacts_title' . $i, 'Student enrolled');
            $mform->setType('config_funfacts_title' . $i, PARAM_TEXT);

            $mform->addElement('text', 'config_funfacts_number' . $i, get_string('config_number', 'theme_edly', $i));
            $mform->setDefault('config_funfacts_number' . $i, '56892');
            $mform->setType('config_funfacts_number' . $i, PARAM_TEXT);

            $mform->addElement('text', 'config_funfacts_prefix' . $i, get_string('config_number_prefix', 'theme_edly', $i));
            $mform->setDefault('config_funfacts_prefix' . $i, '');
            $mform->setType('config_funfacts_prefix' . $i, PARAM_TEXT);

            $select = $mform->addElement('select', 'config_icon' . $i, get_string('config_icon', 'theme_edly'), $edlyFontList, array('class'=>'edly_icon_class'));

        }
    }
}
