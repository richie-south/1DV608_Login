<?php

namespace view;

class LogedInView {
    private static $delete = 'LogedInView::delete';
    private $message;

    private static $checkbox = 'check_list[]';

    public function __construct(){

    }

    public function generateLogedinSite($files) {
        $list = '';
        foreach ($files as $file) {
            $list .= '
            <tr>
                <td>File: '.$file.'<input type="checkbox" name="'.self::$checkbox.'" value="'.$file.'" /></td>
            </tr>';
        }
        return '
            <form method="post">
                <table>
                    <tr>
                        <th>
                            remove
                        </th>
                    </tr>
                    '.$list.'
                </table>
                <input type="submit" name="'.self::$delete.'" value="delete" />
            </form>
        ';
	}

    public function checkDeletePost(){
        return isset($_POST[self::$delete]);
    }
}
