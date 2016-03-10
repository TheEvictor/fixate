/**
 * Module dependencies.
 */

var express =require('express');
var http = require('http');
var mongoose = require('mongoose');
var path = require('path');
var handlebars = require('express3-handlebars')
var bodyParser = require('body-parser');

var activities = require('./routes/activities');
var add = require('./routes/add');
//var register = require('./routes/register');
//var router = require('./routes/routes');
//var homepage = require('./routes/homepage');
// Example route
// var user = require('./routes/user');

var app = express();

var uri = 'mongodb://fixate:teamrhcp@ds011238.mongolab.com:11238/fixation';
mongoose.connect(uri);

// all environments
app.set('port', process.env.PORT || 3000);
app.set('views', __dirname);
//app.set('views', path.join(__dirname, 'views'));
app.engine('handlebars', handlebars());
app.set('view engine', 'handlebars');
app.use(express.favicon());
app.use(express.logger('dev'));
app.use(express.json());
app.use(bodyParser.urlencoded({'extended':'true'}));
app.use(bodyParser.json());
app.use(express.urlencoded());
app.use(express.methodOverride());
app.use(express.cookieParser('Intro HCI secret key'));
app.use(express.session());
app.use(app.router);
app.use(express.static(__dirname ));
//app.use(express.static(path.join(__dirname, 'public')));

// development only
if ('development' == app.get('env')) {
  app.use(express.errorHandler());
}

// Add routes here
app.get('/activities', activities.view);
app.get('/add', add.addActivity);
//app.get('/register', register.cool);
//app.get('/routes');
// Example route
// app.get('/users', user.list);

// New stuff
require('./routes/routes.js')(app);

http.createServer(app).listen(app.get('port'), function(){
  console.log('Express server listening on port ' + app.get('port'));
});