/*
* findOneById
* findOneByInsee
* findByPostalCode
* findByName
* findNearGeoPoint
* findNearPostalCode
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
