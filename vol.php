<?php
$window = new GtkWindow();
$window->set_size_request(148, 240);
$window->connect_simple('destroy', array('Gtk','main_quit'));
$window->add($vbox = new GtkVBox());

// display title
$title = new GtkLabel("Set up Volume Control\n".
"Part 1 - using GtkVScale");
$title->modify_font(new PangoFontDescription("Arial Narrow 8"));
$title->modify_fg(Gtk::STATE_NORMAL, GdkColor::parse("#0000ff"));
$title->set_size_request(-1, 40);
$title->set_justify(Gtk::JUSTIFY_CENTER);
$alignment = new GtkAlignment(0.5, 0.5, 0, 0);
$alignment->add($title);
$vbox->pack_start($alignment, 0);

$vol_adj = GtkVScale::new_with_range(-100, 80, 1); // note 1
$vbox->pack_start(new GtkLabel('Volume'), 0);
$vbox->pack_start($vol_adj, 0);

$vol_adj->set_size_request(10, 160);
$vol_adj->set_inverted(1); // note 2
$vol_adj->connect('format-value', 'on_format_value'); // note 3


$window->show_all();
Gtk::main();

function on_format_value($scale, $value) {
    return $value."dB"; // note 4
}

?>