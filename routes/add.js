var data = require("../data.json");

exports.addActivity = function(req, res) {
	res.render('add', data);

	var newActivity = {
		"description":req.query.description
	};
	console.log(newActivity);

	data["activity"].push(newActivity);
}