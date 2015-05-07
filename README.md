Magento Transactional Email UTM Data.
=======

Set the UTM data for the urls included into transactional emails. Option to set the default values for all emails and the email 
template specific.

Email template parameters that are tracked to append the UTM data:
----

* url
* direct_url
* _query
* query[name]


Configuration for Transactional Emails
----

Configuration->Design->Transactional Emails->UTM values



Examples :
 
1. a href="{{store url="contacts"}}">Contact Us
2. a href="{{store direct_url="category/subcategory.html"}}">Our Latest Range
3. a href="{{store direct_url="category/subcategory.html" _query="a=param_a&b=param_b"}}">Our Latest Range


Core files rewrite : 

* Core_Model_Email_Template_Filter