<?php
$window = new GtkWindow();
$window->set_size_request(400, 200);
$window->connect_simple('destroy', array('Gtk','main_quit'));

$vbox = new GtkVBox();
$window->add($vbox);

// display title
$title = new GtkLabel('Display 2D Array in Table - Part 1');
$title->modify_font(new PangoFontDescription("Times New Roman Italic 10"));
$title->modify_fg(Gtk::STATE_NORMAL, GdkColor::parse("#0000ff"));
$title->set_size_request(-1, 40);
$vbox->pack_start($title, 0, 0);

$table = new GtkTable(); // note 1
$vbox->pack_start($table);

$data = array(
array('', 'header1', 'header2', 'header3'),
array('row0', 1, 2, 3),
array('row1', 4, 5, 6));

display_table ($table, $data); // note 2

function display_table($table, $a) {
    for ($row=0; $row<count($a); ++$row) {
        for ($col=0; $col<count($a[$row]); ++$col) {
            $table->attach(new GtkLabel($a[$row][$col]), $col, $col+1, $row, $row+1); // note 3
        }
    }
}

$window->show_all();
Gtk::main();
?>