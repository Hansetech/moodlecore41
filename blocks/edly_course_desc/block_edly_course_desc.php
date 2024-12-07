<?php
global $CFG;
require_once($CFG->dirroot. '/theme/edly/inc/course_handler/edly_course_handler.php');

class block_edly_course_desc extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_edly_course_desc');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/edly/inc/block_handler/specialization.php');
    }

    public function get_content() {
        global $CFG, $DB, $COURSE, $USER, $PAGE;

        $this->content         =  new stdClass;        

        $edlyCourseHandler = new edlyCourseHandler();
        $edlyCourse = $edlyCourseHandler->edlyGetCourseDetails($COURSE->id);
        $edlyCourseDescription = $edlyCourseHandler->edlyGetCourseDescription($COURSE->id, 99999999999999999999999);

        $edlyCourseShortDescription = strip_tags($edlyCourseHandler->edlyGetCourseDescription($COURSE->id, 99999999999999));
        $edlyCourseShortDescription = implode(' ', array_slice(str_word_count($edlyCourseShortDescription, 2), 0, 15));

        // Get Teacher Name
        foreach($edlyCourse->teachers as $teacher):
            $teacher = $teacher->name;
        endforeach;

        $text = '';

        $text .= '
        <div class="course-details-desc">
            <h3>'.format_text($edlyCourse->fullName).'</h3>
            <p>'.format_text(strip_tags($edlyCourseShortDescription)).'</p>
            <ul class="meta-list">
                <li>
                    <i class="ri-user-3-line"></i>
                    <span>'.format_text($teacher).'</span>
                </li>
                <li>
                    <i class="ri-book-2-line"></i>
                    '.$edlyCourse->enrolments.'
                </li>
                <li>
                    <i class="ri-user-2-line"></i> '. $edlyCourse->edlyRender->updatedDate .'
                </li>            
            </ul>';
            if($edlyCourse->course_price) {
                $text .= '
                <div class="price">'.format_text(get_config('theme_edly', 'site_currency') .''.$edlyCourse->course_price).'</div>';
            }else{
                $text .= '
                <div class="price">'.format_text(get_config('theme_edly', 'free_course_price') ).'</div>';
            } $text .= '
        </div>
        
        <div class="courses-overview pt-75">
            '.$edlyCourseDescription.'
        </div>';

        
        $this->content->footer = '';
        $this->content->text   = $text;

        return $this->content;
    }

    /**
     * The block can be used repeatedly in a page.
     */
    function instance_allow_multiple() {
        return true;
    }

    /**
     * Enables global configuration of the block in settings.php.
     *
     * @return bool True if the global configuration is enabled.
     */
    function has_config() {
        return true;
    }

    /**
     * Sets the applicable formats for the block.
     *
     * @return string[] Array of pages and permissions.
     */
    function applicable_formats() {
        return array(
            'all' => false,
            'my' => false,
            'admin' => false,
            'course-view' => true,
            'course' => false,
        );
    }

}