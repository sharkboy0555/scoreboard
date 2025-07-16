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

    # Prepare scoreboard text lines
    my @lines = (
        "M:$settings->{machine} O:$settings->{order}",
        "P:$settings->
