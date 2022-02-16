window.onload = () => {
    var events = [
        'M416,346.5Q361,443,251.5,440Q142,437,127.5,343.5Q113,250,159,211Q205,172,276,126.5Q347,81,409,165.5Q471,250,416,346.5Z', 
        'M323,305.5Q314,361,238,382Q162,403,96.5,326.5Q31,250,99.5,179Q168,108,230.5,141.5Q293,175,312.5,212.5Q332,250,323,305.5Z',
        'M316,293.5Q300,337,251,335Q202,333,152.5,291.5Q103,250,140.5,188Q178,126,247,131Q316,136,324,193Q332,250,316,293.5Z',
        'M363,284.5Q290,319,232.5,350Q175,381,121,315.5Q67,250,137.5,214Q208,178,277.5,130Q347,82,391.5,166Q436,250,363,284.5Z',
        'M385.5,328Q340,406,265.5,379.5Q191,353,118,301.5Q45,250,100,167.5Q155,85,240,102.5Q325,120,378,185Q431,250,385.5,328Z'
    ]
    const blob = document.querySelector('path')
    var i = 0
    setInterval(() => {
        blob.setAttribute('d', events[i])
        blob.setAttribute('fill', 'RGB(' + Math.floor(Math.random()*255) + "," +  Math.floor(Math.random()*255) + "," +  Math.floor(Math.random()*255) + ")")
        i++
        if(i == 5) {
            i = 0
        }
    }
    , 1000)
}
