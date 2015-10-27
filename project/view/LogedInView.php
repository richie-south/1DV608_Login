<?php

namespace view;

class LogedInView {
    private static $delete = 'LogedInView::Delete';
    private static $logout = 'LogedInView::Logout';
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
                <td>File: <input type="checkbox" name="'.self::$checkbox.'" value="'.$file.'" /><a href="'.$this->navigationView->makeFileNameUrl($file).'">'.$this->navigationView->makeFileNameUrl($file).'</a></td>
            </tr>';
        }
        return '

    <form method="post">
        <section>
            <div class="dialog tall" >

                <div class="content tall2" >
                    <div class="title">Files on server</div><br>
                    <table>
                        <tr>
                            <th>
                                Check to remove
                            </th>
                        </tr>
                        '.$list.'
                    </table>
                </div>

                <div class="button label-blue">
                    <div class="center" fit><input type="submit" name="'.self::$delete.'" value="delete" /></div>
                </div>

                <div class="button">
                    <div class="center" fit><input type="submit" name="'.self::$logout.'" value="Logout"></div>
                </div>
            </div>
        </section>
    </form>
        ';
	}

    public function checkDeletePost(){
        return isset($_POST[self::$delete]);
    }

    public function checkLogoutPost(){
        return isset($_POST[self::$logout]);
    }

    public function getChecktCheckboxes(){
        if(!empty($_POST[self::$checktCheckboxes])){
            return $_POST[self::$checktCheckboxes];
       }
       return null;
    }
}
