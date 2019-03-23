define(['jquery','core/log','qtype_speakautograde/cloudpoodllloader'], function($,log,cloudpoodll) {
    "use strict"; // jshint ;_;

    log.debug('cloudpoodll helper: initialising');

    return {

        uploadstate: false,

        init:  function(opts) {
            this.component = opts['component'];
            this.dom_id = opts['dom_id'];
            this.inputname = opts['inputname'];

            this.register_controls();
            this.register_events();
            this.setup_recorder();
        },

        setup_recorder: function(){
            var that = this;
            var gspeech='';
            var recorder_callback = function(evt){
                switch(evt.type){
                    case 'recording':
                        if(evt.action==='started'){
                            gspeech='';
                           // that.controls.updatecontrol.val();
                        }
                        break;

                    case 'speech':
                        gspeech += '  ' + evt.capturedspeech;
                        that.controls.transcript.val(gspeech);
                        that.controls.answer.val(gspeech);
                        break;
                    case 'awaitingprocessing':
                        if(that.uploadstate!='posted') {
                            that.controls.audiourl.val(evt.mediaurl);
                        }
                        that.uploadstate='posted';
                        break;
                    case 'error':
                        alert('PROBLEM:' + evt.message);
                        break;
                }
            };

            cloudpoodll.init(this.dom_id,recorder_callback);
        },

        register_controls: function(){
          this.controls={};
          this.controls.audiourl =  $('input[name=' +  CSS.escape(this.inputname) + 'audiourl]');
          this.controls.transcript =  $('input[name=' + CSS.escape(this.inputname) + 'transcript]');
          this.controls.answer =  $('input[name=' + CSS.escape(this.inputname) + ']');
        },

        register_events: function(){
            /*
            var that =this;
            this.controls.deletebutton.click(function(){
                if(that.controls.updatecontrol){
                    if(confirm(M.util.get_string('reallydeletesubmission',that.component))){
                        that.controls.updatecontrol.val(-1);
                        that.controls.currentcontainer.html('');
                    }
                }
            });
            */
        }
    };//end of return object
});