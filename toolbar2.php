<?php
$window = new GtkWindow();
$window->set_title($argv[0]);
$window->set_size_request(400, 150);
$window->connect_simple('destroy', array('Gtk','main_quit'));
$window->add($vbox = new GtkVBox());

// define menu definition
// define menu definition
$menu_definition = array( // note 1
    '_File' => array('_New', '_Open', '_Close', '<hr>',
                    '_Save', 'Save _As','<hr>', '_Quit'),
    '_Edit' => array('Cut', 'Copy', '_Paste', '<hr>',
                    'Select All', '<hr>', '_Undo','_Redo'),
);
setup_menu($vbox, $menu_definition);

// display title
$title = new GtkLabel("Set up Menu using GtkAction - Part 1");
$title->modify_font(new PangoFontDescription("Times New Roman Italic 10"));
$title->modify_fg(Gtk::STATE_NORMAL, GdkColor::parse("#0000ff"));
$vbox->pack_start($title);
$vbox->pack_start(new GtkLabel(''));

$window->show_all();
Gtk::main();

function setup_menu($vbox, $menu_definition) { // note 1
    $menubar = new GtkMenuBar(); // note 2
    $vbox->pack_start($menubar, 0, 0);

    foreach($menu_definition as $toplevel => $sublevels) {
        $menubar->append($top_menu = new GtkMenuItem($toplevel));
        $menu = new GtkMenu();
        $top_menu->set_submenu($menu);

        foreach($sublevels as $item) {

            if ($item=='<hr>') {
                $menu->append(new GtkSeparatorMenuItem());
            } else {
                $item2 = str_replace('_', '', $item);
                $item2 = str_replace(' ', '_', $item2);
                $stock_image_name = 'Gtk::STOCK_'.strtoupper($item2);
                $stock_image = '';
                if (defined($stock_image_name))
                    $stock_image = constant($stock_image_name); // note 3

                $action = new GtkAction($item, $item, '', $stock_image); // note 4
                $menu_item = $action->create_menu_item(); // note 5

                $action->connect('activate', 'on_menu_select', $item); // note 6
                $menu->append($menu_item); // note 7
            }
        }
    }
}

// process toolbar
function on_menu_select($button, $item) { // note 8
    echo "menu item selected: $item\n";
    if ($item=='_Quit') Gtk::main_quit();
}

?>