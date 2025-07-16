package ScoreboardOverlay;

use base 'PixelOverlayModel';
use strict;
use warnings;

sub renderFrame {
    my ($self, $frameRef, $args) = @_;

    # Log to confirm the overlay is being called
    $main::log->info("ScoreboardOverlay: renderFrame called");

    # Optional: Display args if passed
    if (defined $args) {
        $main::log->info("ScoreboardOverlay Args: " . $args);
    }

    # Draw a test rectangle (top-left corner)
    for my $y (0 .. 10) {
        for my $x (0 .. 40) {
            $self->SetPixel($frameRef, $x, $y, 0, 255, 0);  # green box
        }
    }

    # Draw test text
    $self->DrawText($frameRef, 5, 20, "TEST", 255, 255, 0);  # yellow "TEST"

    return;
}

1;
