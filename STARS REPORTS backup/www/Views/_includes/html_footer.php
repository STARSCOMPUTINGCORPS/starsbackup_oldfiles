<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/jquery-ui-1.10.0.min.js"></script>
<script type="text/javascript" src="/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/js/TableTools.min.js"></script>

<script type="text/javascript">
	oTable = $('#dataTable').dataTable({
		"sScrollX": "100%",
		"sScrollXInner": "110%",
		"bAutoWidth" : false,
		"bJQueryUI": true,
        "bSort": false,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 25,
        "aLengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ]
    });

    function getURLParanters() {
        var query_string = {};
        var query = window.location.search.substring(1);
        var vars = query.split("&");
        for (var i = 0; i < vars.length; i++) {
            var pair = vars[i].split("=");
            // If first entry with this name
            if (typeof query_string[pair[0]] === "undefined") {
                query_string[pair[0]] = pair[1];
                // If second entry with this name
            } else if (typeof query_string[pair[0]] === "string") {
                var arr = [query_string[pair[0]], pair[1]];
                query_string[pair[0]] = arr;
                // If third or later entry with this name
            } else {
                query_string[pair[0]].push(pair[1]);
            }
        }
        return query_string;
    }

    function updateURLs() {
        var selected = new Array();
        $('.field-menu-item').each(function() {
            if ($(this).prop('checked')) {
                selected.push($(this).val());
            }
        });
        var href = '/index.php?';
        var parameters = getURLParanters();
        href = href + 'q=' + parameters.q;
        var csv_href = href + '-csv';
        var f_param = '';
        if (selected.length > 0) {
            var f = selected.join(',');
            f_param = '&f=' + f;
        }
        href = href + f_param;
        csv_href = csv_href + f_param;
        $('#update-table').attr('href', href);
        $('#csv-download-anchor').attr('href', csv_href);
    }

    $('.field-menu-item').on("change", function(event) {
        updateURLs()
    });
    // Initialize the URLs.
    updateURLs();
    // Disable links, ones to pages that do not exist yet.
    $('.disabled').click(function($event){
        event.preventDefault();
    }).tooltip({ content: "Not implemented yet."});
</script>
</body>
</html>
