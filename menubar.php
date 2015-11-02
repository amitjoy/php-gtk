<?php
$window = new GtkWindow();
$window->set_size_request(400, 150);
$window->connect_simple('destroy', array('Gtk','main_quit'));
$window->add($vbox = new GtkVBox());

// define menu definition
$menu_definition = array(
    '_File' => array('_New', '_Open', '_Close', '_Quit'),
    '_Test' => array('Test1', 'Test2', 'Test3', '<hr>',
                array('Selection 1', 'Selection 2', 'Selection 3'), // note 2
                '<hr>', 'Test4')
);
setup_menu($vbox, $menu_definition); // note 1

// setup menu
function setup_menu($vbox, $menus) { // note 1
    $menubar = new GtkMenuBar();
    $vbox->pack_start($menubar, 0, 0);
    foreach($menus as $toplevel => $sublevels) {
        $menubar->append($top_menu = new GtkMenuItem($toplevel));
        $menu = new GtkMenu();
        $top_menu->set_submenu($menu);
        foreach($sublevels as $submenu) {
            if (is_array($submenu)) { // set up radio menus
                $i=0;
                $radio[0] = null;
                foreach($submenu as $radio_item) {// note 3
                    $radio[$i] = new GtkRadioMenuItem($radio[0], $radio_item);
                    $radio[$i]->connect('toggled', "on_toggle");
                    $menu->append($radio[$i]);
                    ++$i;
                }
                $radio[0]->set_active(1); // select the first item
            } else {
                if ($submenu=='<hr>') {
                    $menu->append(new GtkSeparatorMenuItem());
                } else {
                    $menu->append($menu_item = new GtkMenuItem($submenu));
                    $menu_item->connect('activate', 'on_menu_select');
                }
            }
        }
    }
}

// process radio menu selection
function on_toggle($radio) { // note 3
    $label = $radio->child->get_label();
    $active = $radio->get_active();
    echo("radio menu selected: $label\n");
}

// process menu item selection
function on_menu_select($menu_item) {
    $item = $menu_item->child->get_label();
    echo "menu selected: $item\n";
    if ($item=='_Quit') Gtk::main_quit();
}

// display title
$title = new GtkLabel("Menu and RadioMenuItem");
$title->modify_font(new PangoFontDescription("Times New Roman Italic 10"));
$title->modify_fg(Gtk::STATE_NORMAL, GdkColor::parse("#0000ff"));
$title->set_size_request(-1, 40);
$vbox->pack_start($title, 0, 0);
$vbox->pack_start(new GtkLabel(''));

$window->show_all();
Gtk::main();

?>