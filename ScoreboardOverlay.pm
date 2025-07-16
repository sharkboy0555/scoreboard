sub renderFrame {
    my ($self, $frameRef, $frameNum) = @_;
    $self->ClearFrame($frameRef);

    my $settingsFile = "/home/fpp/media/plugins/scoreboard/settings.json";
    return unless -e $settingsFile;

    my $json = do {
        open my $fh, '<', $settingsFile or return;
        local $/;
        <$fh>;
    };
    my $settings = eval { JSON::decode_json($json) };
    return unless $settings;

    my @lines = (
        "M: $settings->{machine}  O: $settings->{order}",
        "P: $settings->{part}",
        "Setup: $settings->{setup}/$settings->{goal}",
        "Qty: $settings->{currentQty}/$settings->{orderQty}",
        "BPH: $settings->{bphShift}/$settings->{bphStandard}"
    );

    my $y = 0;
    for my $line (@lines) {
        $self->DrawText($frameRef, 0, $y, $line, 0, 255, 0);
        $y += 12;
    }
}
