#!/bin/bash
INPUT_DIR="." 
OUTPUT_DIR="./convert"

mkdir -p "$OUTPUT_DIR"

for input_file in *.mkv; do
  base_filename=$(basename "$input_file" .mkv)
  
  output_file="$OUTPUT_DIR/${base_filename}_burned.mp4"
  
  echo "Processing $input_file ..."
  
  # ajouter -map 0:a:1 pour utiliser le deuxième channel audio
  # modifier :si= pour le channel de sous-titres
  ffmpeg -i "$input_file" -vf "subtitles=$input_file:si="$1"" -c:v libx264 -c:a -strict -2 copy "$output_file"
  
  echo "Output saved to $output_file"
done

echo "All files processed."
