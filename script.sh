i=1
for file in *.mkv; do
    mv "$file" $(printf ""$1"_%02d.mkv" $i)
    i=$((i + 1))
done
