var data = require('../data.json');

exports.view = function(req, res){
	console.log(data);
	res.render('activities', data);
}

/*exports.add = function(req, res) {
	var newActivity = {
		"description":req.query.description
	};
	console.log(newActivity);

	data["activity"].push(newActivity);

	res.render('activities', data);
}*/