//
// Autogenerated by Thrift Compiler (0.11.0)
//
// DO NOT EDIT UNLESS YOU ARE SURE THAT YOU KNOW WHAT YOU ARE DOING
//
"use strict";

var thrift = require('thrift');
var Thrift = thrift.Thrift;
var Q = thrift.Q;


var ttypes = require('./zc_types');
//HELPER FUNCTIONS AND STRUCTURES

var MarkdownService_encode_args = function(args) {
  this.code = null;
  if (args) {
    if (args.code !== undefined && args.code !== null) {
      this.code = args.code;
    }
  }
};
MarkdownService_encode_args.prototype = {};
MarkdownService_encode_args.prototype.read = function(input) {
  input.readStructBegin();
  while (true)
  {
    var ret = input.readFieldBegin();
    var fname = ret.fname;
    var ftype = ret.ftype;
    var fid = ret.fid;
    if (ftype == Thrift.Type.STOP) {
      break;
    }
    switch (fid)
    {
      case 1:
      if (ftype == Thrift.Type.STRING) {
        this.code = input.readString();
      } else {
        input.skip(ftype);
      }
      break;
      case 0:
        input.skip(ftype);
        break;
      default:
        input.skip(ftype);
    }
    input.readFieldEnd();
  }
  input.readStructEnd();
  return;
};

MarkdownService_encode_args.prototype.write = function(output) {
  output.writeStructBegin('MarkdownService_encode_args');
  if (this.code !== null && this.code !== undefined) {
    output.writeFieldBegin('code', Thrift.Type.STRING, 1);
    output.writeString(this.code);
    output.writeFieldEnd();
  }
  output.writeFieldStop();
  output.writeStructEnd();
  return;
};

var MarkdownService_encode_result = function(args) {
  this.success = null;
  if (args) {
    if (args.success !== undefined && args.success !== null) {
      this.success = args.success;
    }
  }
};
MarkdownService_encode_result.prototype = {};
MarkdownService_encode_result.prototype.read = function(input) {
  input.readStructBegin();
  while (true)
  {
    var ret = input.readFieldBegin();
    var fname = ret.fname;
    var ftype = ret.ftype;
    var fid = ret.fid;
    if (ftype == Thrift.Type.STOP) {
      break;
    }
    switch (fid)
    {
      case 0:
      if (ftype == Thrift.Type.STRING) {
        this.success = input.readString();
      } else {
        input.skip(ftype);
      }
      break;
      case 0:
        input.skip(ftype);
        break;
      default:
        input.skip(ftype);
    }
    input.readFieldEnd();
  }
  input.readStructEnd();
  return;
};

MarkdownService_encode_result.prototype.write = function(output) {
  output.writeStructBegin('MarkdownService_encode_result');
  if (this.success !== null && this.success !== undefined) {
    output.writeFieldBegin('success', Thrift.Type.STRING, 0);
    output.writeString(this.success);
    output.writeFieldEnd();
  }
  output.writeFieldStop();
  output.writeStructEnd();
  return;
};

var MarkdownServiceClient = exports.Client = function(output, pClass) {
    this.output = output;
    this.pClass = pClass;
    this._seqid = 0;
    this._reqs = {};
};
MarkdownServiceClient.prototype = {};
MarkdownServiceClient.prototype.seqid = function() { return this._seqid; };
MarkdownServiceClient.prototype.new_seqid = function() { return this._seqid += 1; };
MarkdownServiceClient.prototype.encode = function(code, callback) {
  this._seqid = this.new_seqid();
  if (callback === undefined) {
    var _defer = Q.defer();
    this._reqs[this.seqid()] = function(error, result) {
      if (error) {
        _defer.reject(error);
      } else {
        _defer.resolve(result);
      }
    };
    this.send_encode(code);
    return _defer.promise;
  } else {
    this._reqs[this.seqid()] = callback;
    this.send_encode(code);
  }
};

MarkdownServiceClient.prototype.send_encode = function(code) {
  var output = new this.pClass(this.output);
  output.writeMessageBegin('encode', Thrift.MessageType.CALL, this.seqid());
  var params = {
    code: code
  };
  var args = new MarkdownService_encode_args(params);
  args.write(output);
  output.writeMessageEnd();
  return this.output.flush();
};

MarkdownServiceClient.prototype.recv_encode = function(input,mtype,rseqid) {
  var callback = this._reqs[rseqid] || function() {};
  delete this._reqs[rseqid];
  if (mtype == Thrift.MessageType.EXCEPTION) {
    var x = new Thrift.TApplicationException();
    x.read(input);
    input.readMessageEnd();
    return callback(x);
  }
  var result = new MarkdownService_encode_result();
  result.read(input);
  input.readMessageEnd();

  if (null !== result.success) {
    return callback(null, result.success);
  }
  return callback('encode failed: unknown result');
};
var MarkdownServiceProcessor = exports.Processor = function(handler) {
  this._handler = handler;
}
;
MarkdownServiceProcessor.prototype.process = function(input, output) {
  var r = input.readMessageBegin();
  if (this['process_' + r.fname]) {
    return this['process_' + r.fname].call(this, r.rseqid, input, output);
  } else {
    input.skip(Thrift.Type.STRUCT);
    input.readMessageEnd();
    var x = new Thrift.TApplicationException(Thrift.TApplicationExceptionType.UNKNOWN_METHOD, 'Unknown function ' + r.fname);
    output.writeMessageBegin(r.fname, Thrift.MessageType.EXCEPTION, r.rseqid);
    x.write(output);
    output.writeMessageEnd();
    output.flush();
  }
}
;
MarkdownServiceProcessor.prototype.process_encode = function(seqid, input, output) {
  var args = new MarkdownService_encode_args();
  args.read(input);
  input.readMessageEnd();
  if (this._handler.encode.length === 1) {
    Q.fcall(this._handler.encode.bind(this._handler), args.code)
      .then(function(result) {
        var result_obj = new MarkdownService_encode_result({success: result});
        output.writeMessageBegin("encode", Thrift.MessageType.REPLY, seqid);
        result_obj.write(output);
        output.writeMessageEnd();
        output.flush();
      }, function (err) {
        var result;
        result = new Thrift.TApplicationException(Thrift.TApplicationExceptionType.UNKNOWN, err.message);
        output.writeMessageBegin("encode", Thrift.MessageType.EXCEPTION, seqid);
        result.write(output);
        output.writeMessageEnd();
        output.flush();
      });
  } else {
    this._handler.encode(args.code, function (err, result) {
      var result_obj;
      if ((err === null || typeof err === 'undefined')) {
        result_obj = new MarkdownService_encode_result((err !== null || typeof err === 'undefined') ? err : {success: result});
        output.writeMessageBegin("encode", Thrift.MessageType.REPLY, seqid);
      } else {
        result_obj = new Thrift.TApplicationException(Thrift.TApplicationExceptionType.UNKNOWN, err.message);
        output.writeMessageBegin("encode", Thrift.MessageType.EXCEPTION, seqid);
      }
      result_obj.write(output);
      output.writeMessageEnd();
      output.flush();
    });
  }
};
