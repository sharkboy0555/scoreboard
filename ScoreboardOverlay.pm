package ScoreboardOverlay;

use strict;
use warnings;
use base 'PixelOverlayModel';
use JSON;

sub new {
    my ($class, $name, $channel, $startChannel, $width, $height, $args) = @_;
    my $self = $class->SUPER::new($name, $channel, $startChannel, $width, $height, $args);
    bless($self, $class);
    return $self;
}

sub renderFrame {
    my ($self, $frameRef, $frameNum) = @_;
    $self->ClearFrame($frameRef);

    my $settingsFile = "/home/fpp/media/plugins/scoreboard/settings.json";
    return unless -e $settingsFile;

    open my $fh, '<', $settingsFile or return;
    local $/;
    my $json_text = <$fh>;
    close $fh;

    my $settings = eval { decode_json($json_text) };
    return unless $settings;

    my @lines = (
        "M:$settings->{machine} O:$settings->{order}",
        "P:$settings->{part} Q:$settings->{qty}",
        "S:$settings->{setup_time} G:$settings->{setup_goal}",
        "B:$settings->{bph} Std:$settings->{bph_std}"
    );

    my $y = 0;
    foreach my $line (@lines) {
        $self->DrawText($frameRef, 0, $y, $line, 'white', 'helvB08');
        $y += 8;
    }
}

1;
