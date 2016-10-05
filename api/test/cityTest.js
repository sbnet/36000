/*
Paging

Use limit and offset. It is flexible for the user and common in leading databases. The default should be limit=20 and offset=0

GET /cars?offset=10&limit=5
To send the total entries back to the user use the custom HTTP header: X-Total-Count.

Links to the next or previous page should be provided in the HTTP header link as well. It is important to follow this link header values instead of constructing your own URLs.

Link: <https://blog.mwaysolutions.com/sample/
*/
var chai = require('chai');
var chaiHttp = require('chai-http');
var app = require('../app');
var should = chai.should();

chai.use(chaiHttp);

describe('City test', function(){

  it('should get one city by its ID', (done) => {
    chai.request(app)
        .get('/city/id/36657')
        .end((err, res) => {
            res.should.have.status(200);
            res.body.length.should.be.above(0);
            res.body.should.be.a('array');
            res.body[0].should.be.a('object');
            res.body[0].should.have.property('name').eql('Châteauneuf-de-Gadagne');
          done();
        });
  });

  it('should get one city by its INSEE code', (done) => {
    chai.request(app)
        .get('/city/insee/84036')
        .end((err, res) => {
          res.should.have.status(200);
          res.body.length.should.be.above(0);
          res.body.should.be.a('array');
          res.body[0].should.be.a('object');
          res.body[0].should.have.property('name').eql('Châteauneuf-de-Gadagne');
          done();
        });
  });

  it('should get one city by its postal code', (done) => {
    chai.request(app)
        .get('/city/postal/84470')
        .end((err, res) => {
          res.should.have.status(200);
          res.body.length.should.be.above(0);
          res.body.should.be.a('array');
          res.body[0].should.be.a('object');
          res.body[0].should.have.property('name').eql('Châteauneuf-de-Gadagne');
          done();
        });
  });

  it('should search a city by its name', (done) => {
    chai.request(app)
        .get('/city/search/CHATEAUNEUFDEGAD')
        .end((err, res) => {
          res.should.have.status(200);
          res.body.length.should.be.above(0);
          res.body.should.be.a('array');
          res.body[0].should.be.a('object');
          res.body[0].should.have.property('name').eql('Châteauneuf-de-Gadagne');
          done();
        });
  });

  it('should get nearest cities from a geopoint', (done) => {
    chai.request(app)
        .get('/city/geo/??')
        .end((err, res) => {
          res.should.have.status(200);
          res.body.length.should.be.above(0);
          res.body.should.be.a('array');
          res.body[0].should.be.a('object');
          done();
        });
  });

  it('should get nearest cities from a postcode', (done) => {
    chai.request(app)
        .get('/city/near/??')
        .end((err, res) => {
          res.should.have.status(200);
          res.body.length.should.be.above(0);
          res.body.should.be.a('array');
          res.body[0].should.be.a('object');
          done();
        });
  });

});
