<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Jquery_pagination {

    var $base_url = '';
    var $total_rows = '';
    var $per_page = 2;
    var $num_links = 3;
    var $cur_page = 0;
    var $first_link = 'Pertama';
    var $next_link = '&gt;';
    var $prev_link = '&lt;';
    var $last_link = 'Terakhir';
    var $uri_segment = 3;
    var $full_tag_open = '<ul class="paging">';
    var $full_tag_close = '</ul>';
    var $first_tag_open = '<li>';
    var $first_tag_close = '</li>';
    var $last_tag_open = '<li>';
    var $last_tag_close = '</li>';
    var $cur_tag_open = '<li>';
    var $cur_tag_close = '</li>';
    var $next_tag_open = '<li>';
    var $next_tag_close = '</li>';
    var $prev_tag_open = '<li>';
    var $prev_tag_close = '</li>';
    var $num_tag_open = '<li>';
    var $num_tag_close = '</li>';
    var $cur_paging = 0;
    var $js_rebind = '';
    var $div = '';
    var $postVar = '';
    var $additional_param = '';
    var $anchor_class = '';
    var $show_count = true;
    var $base_filter = '';
    var $url_location = '';

    function __contruct($params = array()) {
        if (count($params) > 0) {
            $this->initialize($params);
        }

        log_message('debug', "Jquery Pagination Class Initialized");
    }

    function initialize($params = array()) {
        if (count($params) > 0) {
            foreach ($params as $key => $val) {
                if (isset($this->$key)) {
                    $this->$key = $val;
                }
            }
        }
        if ($this->anchor_class != '') {
            $this->anchor_class = 'class="' . $this->anchor_class . '" ';
        }
    }

    function create_links() {
        if ($this->total_rows == 0 OR $this->per_page == 0) {
            return '';
        }

        $num_pages = ceil($this->total_rows / $this->per_page);

        $CI = & get_instance();

        if ($CI->uri->segment($this->uri_segment) != 0) {
            $this->cur_page = $CI->uri->segment($this->uri_segment);
            $this->cur_page = (int) $this->cur_page;
        }

        $this->num_links = (int) $this->num_links;

        if ($this->num_links < 1) {
            show_error('Your number of links must be a positive number.');
        }

        if (!is_numeric($this->cur_page)) {
            $this->cur_page = 0;
        }

        if ($this->cur_page > $this->total_rows) {
            $this->cur_page = ($num_pages - 1) * $this->per_page;
        }

        $uri_page_number = $this->cur_page;
        $this->cur_page = floor(($this->cur_page / $this->per_page) + 1);

        $start = (($this->cur_page - $this->num_links) > 0) ? $this->cur_page - ($this->num_links - 1) : 1;
        $end = (($this->cur_page + $this->num_links) < $num_pages) ? $this->cur_page + $this->num_links : $num_pages;

        $this->base_url = rtrim($this->base_url, '/') . '/';

        $output = '';


        if ($this->show_count) {
            $curr_offset = is_numeric($CI->uri->segment($this->uri_segment));
            $info = ' Menampilkan <b>' . ( $curr_offset + 1 ) . '</b> sampai <b>';

            if (( $curr_offset + $this->per_page ) < ( $this->total_rows - 1 ))
                $info .= $curr_offset + $this->per_page;
            else
                $info .= $this->total_rows;

            $info .= '</b> dari total <b>' . $this->total_rows . '</b>';

            $output .= $this->first_tag_open . "<a>" . $info . "</a>" . $this->first_tag_close;
        }


        if ($this->cur_page > $this->num_links) {
            $output .= $this->first_tag_open
                    . $this->getAJAXlink(0, $this->first_link)
                    . $this->first_tag_close;
        }

        if ($this->cur_page != 1) {
            $i = $uri_page_number - $this->per_page;
            if ($i == 0)
                $i = 0;
            $output .= $this->prev_tag_open
                    . $this->getAJAXlink($i, $this->prev_link)
                    . $this->prev_tag_close;
        }

        for ($loop = $start - 1; $loop <= $end; $loop++) {
            $i = ($loop * $this->per_page) - $this->per_page;

            if ($i >= 0) {
                if ($this->cur_page == $loop) {
                    $output .= "<li class='active'>" . $this->getAJAXlink(0, $loop) . $this->num_tag_close;
                } else {
                    $n = ($i == 0) ? 0 : $i;
                    $output .= $this->num_tag_open . $this->getAJAXlink($n, $loop) . $this->num_tag_close;
                }
            }
        }

        if ($this->cur_page < $num_pages) {
            $output .= $this->next_tag_open . $this->getAJAXlink($this->cur_page * $this->per_page, $this->next_link) . $this->next_tag_close;
        }

        if (($this->cur_page + $this->num_links) < $num_pages) {
            $i = (($num_pages * $this->per_page) - $this->per_page);
            $output .= $this->last_tag_open . $this->getAJAXlink($i, $this->last_link) . $this->last_tag_close;
        }

        $output = preg_replace("#([^:])//+#", "\\1/", $output);
        $output = $this->full_tag_open . $output . $this->full_tag_close;
        return $output;
    }

    function getAJAXlink($count, $text) {

        if ($this->div == '' AND $this->base_filter != '') {
            $replace = urldecode($this->base_filter);
            if ($this->url_location != '') {
                return '<a href="' . $this->anchor_class . ' ' . $this->base_url . $count . $replace . '" id="' . $this->url_location . '">' . $text . '</a>';
            } else {
                return '<a href="' . $this->anchor_class . ' ' . $this->base_url . $count . $replace . '">' . $text . '</a>';
            }
        } elseif ($this->div == '') {
            if ($this->url_location != '') {
                return '<a href="' . $this->anchor_class . ' ' . $this->base_url . $count . '" id="' . $this->url_location . '">' . $text . '</a>';
            }
            return '<a href="' . $this->anchor_class . ' ' . $this->base_url . $count . '">' . $text . '</a>';
        }

        if ($this->additional_param == '')
            $this->additional_param = "{'t' : 't'}";

        return "<a href=\"#\"
                 " . $this->anchor_class . "
                    onclick=\"$.post('" . $this->base_url . $count . "', " . $this->additional_param . ", function(data){
                    $('" . $this->div . "').html(data);" . $this->js_rebind . "; }); return false;\">"
                . $text . '</a>';
    }

}

?>