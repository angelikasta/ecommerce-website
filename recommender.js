//Constructor for the recommender object
function Recommender(){
    this.keywords = {};//Holds the keywords
    this.timeWindow = 10000;//Keywords older than this window will be deleted
    this.load();
}


//Adds a keyword to the reommender
Recommender.prototype.addKeyword = function(word){
    //Increase count of keyword
    if(this.keywords[word] === undefined)
        this.keywords[word] = {count: 1, date: new Date().getTime()};
    else{
        this.keywords[word].count++;
        this.keywords[word].date = new Date().getTime();
    }
    
    console.log(JSON.stringify(this.keywords));
    
    //Save state of recommender
    this.save();
};


/* Returns the most popular keyword */
Recommender.prototype.getTopKeyword = function(){
    //Clean up old keywords
    this.deleteOldKeywords();
    
    //Return word with highest count
    var maxCount = 0;
    var maxKeyword = "";
    for(var word in this.keywords){
        if(this.keywords[word].count > maxCount){
            maxCount = this.keywords[word].count;
            maxKeyword = word;
        }
    }
    return maxKeyword;
};


/* Saves state of recommender. Currently this uses local storage, 
    but it could easily be changed to save on the server */
Recommender.prototype.save = function(){
    localStorage.recommenderKeywords = JSON.stringify(this.keywords);
};


/* Loads state of recommender */
Recommender.prototype.load = function(){
    if(localStorage.recommenderKeywords === undefined)
        this.keywords = {};
    else
        this.keywords = JSON.parse(localStorage.recommenderKeywords);
    
    //Clean up keywords by deleting old ones
    this.deleteOldKeywords();
};


//Removes keywords that are older than the time window
Recommender.prototype.deleteOldKeywords = function(){
    var currentTimeMillis = new Date().getTime();
    for(var word in this.keywords){
        if(currentTimeMillis - this.keywords[word].date > this.timeWindow){
            delete this.keywords[word];
        }
    }
};


