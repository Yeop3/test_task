$(function() {
    $('#exchange_from')
    $('#exchange_from').on('submit', function(e){
        e.preventDefault()
        let formData = new FormData(e.target)
        $.ajax('/api/sendForm', {
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            success: (data) => {
                $('#result').html(JSON.parse(data).data)
            }
        })
    }
    )
    $('#count').on('change', function (e) {
        let formData = new FormData()
        formData.append('countList', e.target.value)
        $.ajax('/api/countList', {
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            success: (data) => {
            }
        })
    })
    $('.currency_checkbox').on('change', function (e){
        let formData = new FormData()
        formData.append('currency_id', e.target.value)
        formData.append('currency_value', e.target.checked ? 1 : 0)
        $.ajax('/api/currencySetting', {
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            success: (data) => {
            }
        })
    })
});