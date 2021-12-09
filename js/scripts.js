/*
    v1 - initial creation
    v1.1 - jQuery noCoflict
*/

jQuery(function() {
	$container = jQuery('<div class="cos_courses_filters" />');
	$search = jQuery('<span><label for="cos_courses_filter">Search: </label><input type="text" id="cos_courses_filter" name="cos_courses_filter" /></span>');
	$radio_current = jQuery('<span><input type="radio" checked="checked" id="cos_courses_current" name="cos_courses_terms" /><label class="cos_courses" for="cos_courses_current"> Current Courses Only</label></span>');
	$radio_archive = jQuery('<span><input type="radio" id="cos_courses_archive" name="cos_courses_terms" /><label class="cos_courses" for="cos_courses_archive"> Course Archive</label></span>');
	$search.keyup(updateFilters);
	$radio_current.click(updateFilters);
	$radio_archive.click(updateFilters);
	$container.append($search, $radio_current, $radio_archive);
	jQuery('div.cos_courses').first().before($container);
});
function updateFilters() {
	// current vs archive
	var courses_current = jQuery('#cos_courses_current').prop('checked');
	jQuery('div.cos_courses>div').show();
	jQuery('div.cos_courses>div.archive').each(function() {
		if (courses_current) jQuery(this).hide();
		else jQuery(this).show();
	});

	// search
	var courses_param = jQuery('#cos_courses_filter').val().toLowerCase();
	var courses_needles = [];
	// parse quoted terms
	courses_param.replace(/\"([^\"]*)\"?/gi, function(m, p1) {
			courses_needles.push(p1);
			courses_param = courses_param.replace(m, '').trim();
		});
	// parse remaining terms
	var courses_terms = courses_param.split(' ')
	for (i=0; i<courses_terms.length; i++) courses_needles.push(courses_terms[i]);
	// search visible courses for needles
	jQuery('div.cos_courses>div:visible').each(function() {
		courses_filter_match = true;
		courses_filter_haystack = jQuery(this).text().toLowerCase();
		for (i=0; i<courses_needles.length; i++) {
			if (courses_filter_haystack.search(courses_needles[i]) < 0) {
				courses_filter_match = false;
				break;
			}
		}
		if (courses_filter_match) jQuery(this).show();
		else jQuery(this).hide();
	});
}
