<?php
$window = new GtkWindow();
$window->set_size_request(400, 240);
$window->connect_simple('destroy', array('Gtk','main_quit'));
$window->set_position(Gtk::WIN_POS_CENTER_ALWAYS);
$window->add($vbox = new GtkVBox());

// display title
$title = new GtkLabel("Search for text in GtkTextView - Part 1\n");
$title->modify_font(new PangoFontDescription("Times New Roman Italic 10"));
$title->modify_fg(Gtk::STATE_NORMAL, GdkColor::parse("#0000ff"));
$title->set_size_request(-1, 60);
$title->set_justify(Gtk::JUSTIFY_CENTER);
$alignment = new GtkAlignment(0.5, 0, 0, 0);
$alignment->add($title);
$vbox->pack_start($alignment, 0, 0);
$vbox->pack_start(new GtkLabel(), 0, 0);

$hbox = new GtkHBox();
$hbox->pack_start(new GtkLabel("Search string: "), 0);
$hbox->pack_start($entry = new GtkEntry(), 0);
$hbox->pack_start($button_search = new GtkButton('Search'), 0);
$vbox->pack_start($hbox, 0);
$button_search->connect('clicked', 'on_search_button', $entry); // note 1

// Create a new buffer and a new view to show the buffer.
$buffer = new GtkTextBuffer();
$view = new GtkTextView();
$view->set_buffer($buffer);
$view->modify_font(new PangoFontDescription("Verdana italic 14"));
$view->set_wrap_mode(Gtk::WRAP_WORD);

$scrolled_win = new GtkScrolledWindow();
$scrolled_win->set_policy( Gtk::POLICY_AUTOMATIC, Gtk::POLICY_AUTOMATIC);
$vbox->pack_start($scrolled_win);
$scrolled_win->add($view);

$window->show_all();
Gtk::main();

function on_search_button($widget, $entry) {
    global $view, $buffer;
    $search_str = $entry->get_text();
    $start_iter = $buffer->get_start_iter(); // note 2
    $match_start = $buffer->get_start_iter(); // note 3
    $match_end = $buffer->get_end_iter(); // note 4
    $found = $start_iter->forward_search($search_str, 0, $match_start, $match_end, null); // note 5
    if ($found) {
        $buffer->select_range($match_start, $match_end); // note 6
    }
}

?>