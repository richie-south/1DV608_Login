<?php

namespace view;

class LogedInView {
    private static $delete = 'LogedInView::Delete';
    private static $checkbox = 'check_list[]';
    private static $checktCheckboxes = 'check_list';
    private $message;
    private $navigationView;

    public function __construct(\view\NavigationView $nav){
        $this->navigationView = $nav;
    }

    public function generateLogedinSite($files) {
        $list = '';
        foreach ($files as $file) {
            $list .= '
            <tr>
                <td>File: <a href="'.$this->navigationView->makeFileNameUrl($file).'">'.$this->navigationView->makeFileNameUrl($file).'</a><input type="checkbox" name="'.self::$checkbox.'" value="'.$file.'" /></td>
            </tr>';
        }
        return '
            <form method="post">
                <table>
                    <tr>
                        <th>
                            Check to remove
                        </th>
                    </tr>
                    '.$list.'
                </table>
                <input type="submit" name="'.self::$delete.'" value="delete" />
            </form>
            <a href="?'.$this->navigationView->getLogoutURL().'">Logout</a>
        ';
	}

    public function checkDeletePost(){
        return isset($_POST[self::$delete]);
    }

    public function checkCheckboxPost(){
        return isset($_POST[self::$checkbox]);
    }

    public function getChecktCheckboxes(){
        //return $_POST[self::$checkbox];

        if(!empty($_POST[self::$checktCheckboxes])){
            /*foreach($_POST[self::$checktCheckboxes] as $id){
                //echo "$report_id was checked! ";
                var_dump($id);
                echo"<br/>";
            }*/
            return $_POST[self::$checktCheckboxes];
       }
       return null;
    }
}
