<?php
$window = new GtkWindow();
$window->set_size_request(400, 200);
$window->connect_simple('destroy', array('Gtk','main_quit'));
$window->add($vbox = new GtkVBox());

// display title
$title = new GtkLabel("Display 2D Array in GtkTreeView - Part 1");
$title->modify_font(new PangoFontDescription("Times New Roman Italic 10"));
$title->modify_fg(Gtk::STATE_NORMAL, GdkColor::parse("#0000ff"));
$title->set_size_request(-1, 40);
$vbox->pack_start($title, 0, 0);
$vbox->pack_start(new GtkLabel(), 0, 0);

// the 2D table
$data = array(
array('row0', 'item 1', 2, 3.1),
array('row1', 'item 4', 5, 6.21),
array('row2', 'item 7', 8, 9.36),
array('row3', 'item 10', 11, 12.4),
array('row4', 'item 21', 14, 15.5),
array('row5', 'item 36', 17, 18.6),
array('row6', 'item 42', 20, 21.73));

display_table($vbox, $data); // note 1

$window->show_all();
Gtk::main();

function display_table($vbox, $data) {

    // Set up a scroll window
    $scrolled_win = new GtkScrolledWindow();
    $scrolled_win->set_policy( Gtk::POLICY_AUTOMATIC,
        Gtk::POLICY_AUTOMATIC);
    $vbox->pack_start($scrolled_win);

    // Creates the list store
    if (defined("GObject::TYPE_STRING")) {
        $model = new GtkListStore(GObject::TYPE_STRING, GObject::TYPE_STRING,
                    GObject::TYPE_LONG, GObject::TYPE_DOUBLE); // note 2
    } else {
        $model = new GtkListStore(Gtk::TYPE_STRING, Gtk::TYPE_STRING,
                    Gtk::TYPE_LONG, Gtk::TYPE_DOUBLE); // note 2
    }
    $field_header = array('Row #', 'Description', 'Qty', 'Price'); // note 3

    // Creates the view to display the list store
    $view = new GtkTreeView($model); // note 4
    $scrolled_win->add($view); // note 5

    // Creates columns
    for ($col=0; $col<count($field_header); ++$col) {
        $cell_renderer = new GtkCellRendererText();
        $column = new GtkTreeViewColumn($field_header[$col],
            $cell_renderer, 'text', $col);
        $view->append_column($column);
    }

    // pupulates the data
    for ($row=0; $row<count($data); ++$row) {
        $values = array();
        for ($col=0; $col<count($data[$row]); ++$col) {
            $values[] = $data[$row][$col];
        }
        $model->append($values); // note 6
    }
}

?>