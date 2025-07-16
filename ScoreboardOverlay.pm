package ScoreboardOverlay;
use base 'PixelOverlayModel';
use strict;
use warnings;
use JSON;

sub new {
  my ($class, $name, $channel, $startCh, $w, $h, $args) = @_;
  my $self = $class->SUPER::new($name,$channel,$startCh,$w,$h,$args);
  bless $self, $class;
  return $self;
}

sub renderFrame {
  my ($self, $frameRef, $frameNum) = @_;

  $self->ClearFrame($frameRef);

  # Draw test block and "TEST" text
  $self->DrawText($frameRef, 0, 0, "TEST", 255,255,0);

  for my $y (0..10) {
    for my $x (0..40) {
      $self->SetPixel($frameRef, $x, $y, 0, 255, 0);
    }
  }

  # Future: Read scoreboard settings.json here
}

1;
