import urllib.parse, urllib.request, json
import pandas as pd
from csv import writer
from csv import reader
import csv


def CallWikifier(text, lang="en", threshold=0.9):
    wikified_list =[]
    # Prepare the URL.
    data = urllib.parse.urlencode([
        ("text", text), ("lang", lang),
        ("userKey", "qjtjcmrbvorvuxfzfyxxoucagxpreb"),
        ("pageRankSqThreshold", "%g" % threshold), ("applyPageRankSqThreshold", "true"),
        ("nTopDfValuesToIgnore", "200"), ("nWordsToIgnoreFromList", "200"),
        ("wikiDataClasses", "true"), ("wikiDataClassIds", "false"),
        ("support", "true"), ("ranges", "false"), ("minLinkFrequency", "2"),
        ("includeCosines", "false"), ("maxMentionEntropy", "3")
        ])
    url = "http://www.wikifier.org/annotate-article"
    # Call the Wikifier and read the response.
    req = urllib.request.Request(url, data=data.encode("utf8"), method="POST")
    with urllib.request.urlopen(req, timeout = 60) as f:
        response = f.read()
        response = json.loads(response.decode("utf8"))
    # Output the annotations.

    for annotation in response["annotations"]:
        json_object = {}
        json_object['term'] = annotation["title"]
        json_object['url'] = annotation["url"]
        wikified_list.append(json_object)
#         print("%s (%s)" % (annotation["title"], annotation["url"]))
    
    return wikified_list

new_column = 'wikifier_terms'
with open('Downloads/metadata_abstract.csv', 'r') as read_obj,         open('Downloads/metadata_abstract_1.csv', 'w', newline='') as write_obj:
        # Create a csv.writer object from the output file object
        field_names = ['etd_file_id','advisor','author','degree','program','title','university','year','text','wikifier_terms']
        csv_writer = csv.DictWriter(write_obj, fieldnames=field_names)
        csv_reader = csv.DictReader(read_obj)
#         next(csv_reader)

        # Read each row of the input csv file as list
        for row in csv_reader:
#             print(row['text'])
            wikify = CallWikifier(row['text'])
#             print(wikify)
            # Append the default text in the row / list
#             row.append(default_text)
            row['wikifier_terms'] = wikify
#             # Add the updated row / list to the output file
#             print(row)
            csv_writer.writerow(row)
            
        print("\n")
    
