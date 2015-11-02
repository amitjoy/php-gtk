<?php
$window = new GtkWindow();
$window->set_title('Amit');
$window->set_size_request(470, 150);
$window->connect_simple('destroy', array('Gtk','main_quit'));
$window->add($vbox = new GtkVBox());

// define menu definition
$toolbar_definition = array('New', 'open', 'Save','Save As','Print','Preview', '<hr>', // note 1
    'Cut', 'Copy', 'Paste', '<hr>', 
    'Undo','Redo'); 
setup_toolbar($vbox, $toolbar_definition);

// display title
$title = new GtkLabel("Set up Toolbar");
$title->modify_font(new PangoFontDescription("Times New Roman Italic 10"));
$title->modify_fg(Gtk::STATE_NORMAL, GdkColor::parse("#0000ff"));
$vbox->pack_start($title);
$vbox->pack_start(new GtkLabel(''));

$window->show_all();
Gtk::main();

// setup toolbar
function setup_toolbar($vbox, $toolbar_definition) { // note 1
    $toolbar = new GtkToolBar(); // note 2
    $vbox->pack_start($toolbar, 0, 0);
    foreach($toolbar_definition as $item) {
        if ($item=='<hr>') {
            $toolbar->insert(new GtkSeparatorToolItem(),-1);
        } else {
            $stock_image_name = 'Gtk::STOCK_'.strtoupper($item); // note 3
            if (defined($stock_image_name)) {
                $toolbar_item = GtkToolButton::new_from_stock( // note 4
                    constant($stock_image_name)); 
                $toolbar->insert($toolbar_item, -1); // note 5
                $toolbar_item->connect('clicked', 'on_toolbar_button', $item);
            }
        }
    }
}

// process toolbar
function on_toolbar_button($button, $item) { // note 6
    echo "toolbar clicked: $item\n";
}

?>