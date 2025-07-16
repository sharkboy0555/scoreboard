package ScoreboardOverlay;

use strict;
use warnings;
use base 'PixelOverlayModel';

sub new {
    my ($class, $name, $channel, $startChannel, $width, $height, $args) = @_;
    my $self = $class->SUPER::new($name, $channel, $startChannel, $width, $height, $args);
    bless($self, $class);
    return $self;
}

sub renderFrame {
    my ($self, $frameRef, $frameNum) = @_;

    # Example: Just render static text centered
    $self->ClearFrame($frameRef);
    $self->DrawText($frameRef, 5, 5, 'Score', 255, 255, 0);
    $self->DrawText($frameRef, 5, 20, '123-456', 0, 255, 0);
}

1;
