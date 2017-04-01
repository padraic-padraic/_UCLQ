import MySQLdb
import re

db = MySQLdb.connect(user='qtest', db='uclq', passwd='test123', port=3307)
c=db.cursor()
q_string = "SELECT id,post_content FROM wp_posts WHERE (post_type='page' OR post_type='post')"
u_string = "UPDATE wp_posts SET post_content='{0}' WHERE id={1}"
total = c.execute(q_string)
posts = c.fetchall()
exception_ids = []

for _id, content in posts:
    if (re.search(r'\[(.*?)\]', content)==None):
        print("No matches, skipping for id: {}".format(_id))
        continue
    new_str = re.sub(r'\[(.*?)\]', r'', content)
    new_str = new_str.strip()
    try:
        rows = c.execute(u_string.format(new_str, _id))
    except:
        print('Failed with exception for id: {}'.format(_id))
        with open('{}.txt'.format(_id), 'w') as f:
            f.write(new_str)
        exception_ids.append(_id)
        continue
    if (rows==1):
        print('Succeeded for id: {}'.format(_id))
    else:
        print('Failed for id: {}'.format(_id))

cont = input('Commit? y/n \n')
if cont=='y':
    db.commit()
else:
    print('Okay, you said don\'t.')

print("Failed for:")
for _id in exception_ids:
    print(_id)
