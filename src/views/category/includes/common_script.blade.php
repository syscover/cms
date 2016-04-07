<script>
    $(document).ready(function() {
        // launch slug function when change title and slug
        $("[name=name], [name=slug]").on('change', function(){
            $("[name=slug]").val(getSlug($(this).val(),{
                separator: '-',
                lang: '{{ $lang->id_001 }}'
            }));
            $.checkSlug();
        });
    });

    <!-- Check slug -->
    $.checkSlug = function() {
        $.ajax({
            dataType:   'json',
            type:       'POST',
            url:        '{{ route('apiCheckSlugCmsCategory') }}',
            data:       {
                lang:   '{{ $lang->id_001 }}',
                slug:   $('[name=slug]').val(),
                id:     $('[name=id]').val()
            },
            headers:  {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success:  function(data)
            {
                $("[name=slug]").val(data.slug);
            }
        });
    }
    <!-- /.Check slug -->
</script>