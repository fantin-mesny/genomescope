<!DOCTYPE html>

<html>

<!--    NAVIGATION BAR-->
<?php include "header.html";?>
<?php include "title.html";?>

<!--INSTRUCTIONS-->

<div class="row">
          <div class="col-lg-5"> 
              <div class="panel panel-default">
                          <div class="panel-heading"> <h3 class="panel-title">Run GenomeScope</h3></div>
                          <div class="panel-body">
                                <!--    DROPZONE   -->
                                <div class="center"> 
                                    <form action="file_upload.php"
                                        class="dropzone"
                                        id="myAwesomeDropzone">
                                        <!-- <div class="dz-message" data-dz-message><span>Drop jellyfish file here or click to upload</span></div> -->
                                        <input type="hidden" name="code_hidden" value="">
                                    </form>
                                    
                                    <!--    SUBMIT BUTTON with hidden field to transport code to next page   -->
                                    <form name="input_code_form" action="input_validation.php"  method="post">
                                          <p>
                                            <div class="input-group input-group-lg">
                                              <span class="input-group-addon">Description</span>
                                               <input type="text" name="description" class="form-control" value = "my sample">
                                            </div>
                                          </p>
                                          <p>
                                            <div class="input-group input-group-lg">
                                              <span class="input-group-addon">Kmer length</span>
                                               <input type="number" step="1" name="kmer_length" class="form-control" value = "21">
                                            </div>
                                          </p>
                                          <p>
                                            <div class="input-group input-group-lg">
                                              <span class="input-group-addon">Read length</span>
                                               <input type="number" step="1" name="read_length" class="form-control" value = "100">
                                            </div>
                                          </p>
                                          <p>
                                            <div class="input-group input-group-lg">
                                              <span class="input-group-addon">Max kmer coverage</span>
                                               <input type="number" step="1" name="max_kmer_cov" class="form-control" min="-1" value = "1000">
                                            </div>
                                          </p>
                                          <p id="analysis_form">
                                        <!--  submit button set from within kmers.js --> 
                                          </p>
                                          
                                    </form>
                                </div>
                                <!--   end of DROPZONE   -->
                            </div>
                            <!-- End of panel body -->
                </div> 
                <!-- end of panel -->
          </div>

          <div class="col-lg-7"> 
              <div class="panel panel-default">
                    <div class="panel-heading"> <h3 class="panel-title">Instructions</h3></div>
                    <div class="panel-body"><p>Upload results from running Jellyfish. Example: <a href="tests/inputk21.hist" target="_blank">inputk21.hist</a> </p><p>Instructions for running Jellyfish: <ol><li>Download and install jellyfish from:
                        <a href="http://www.genome.umd.edu/jellyfish.html#Release" target="_blank">http://www.genome.umd.edu/jellyfish.html#Release</a></li>
                        <li>Count kmers using jellyfish:
                        <p><pre>$ jellyfish count -C -m 21 -s 1000000000 -t 10 *.fastq -o reads.jf</pre></p>
                        <p>
                        Note you should adjust the memory (-s) and threads (-t) parameter according to your server. This example will use 10 threads and 1GB of RAM. The kmer length (-m) may need to be scaled if you have low coverage or a high error rate. You should always use "canonical kmers" (-C)
                        </p></li>
                        <li>Export the kmer count histogram
                        <p><pre>$ jellyfish histo -t 10 reads.jf > reads.histo</pre></p>
                        <p>Again the thread count (-t) should be scaled according to your server.</p></li>
                        <li>Upload reads.histo to GenomeScope</li>
                        </ol>

                        Note: High copy-number DNA such as chloroplasts can confuse the model. Set a max kmer coverage to avoid this. Default is -1 meaning no filter. 
                        </p>
                    </div>
              </div>
          </div>
</div>
<!--View analysis later-->
<div id="codepanel">
    <div class="panel panel-default">
      <div class="panel-heading"><h3 class="panel-title">View analysis later</h3></div>
      <div id="code" class="panel-body">
        <!--  contents set from within kmers.js --> 
      </div>

    </div>
</div>


<!--scripts at the end of the file so they don't slow down the html loading-->
<script src="js/kmers.js"></script>
<script src="js/dropzone.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script type="text/javascript">
Dropzone.options.myAwesomeDropzone = {
  accept: function(file, done) {
    console.log("uploaded");
    done();
  },
  init: function() {
    this.on("addedfile", function() {
      if (this.files[1]!=null){
        this.removeFile(this.files[0]);
      }
    });
  }
};  

</script>
</body>
</html>
