# Student Learning Companion
## Introduction
We understand how impactful the pandemic was in transforming our primary, secondary and tertiary educations overnight. We felt that educational facilities aside from simply those for attending virtual classes were just as important. Evaluation of assessment forms and facilities for note taking and saving are some very basic and essential actions integral to modern education systems. A website which combines thee facilities along with secure personal accounts for teachers and students would be very effective at facilitating virtual learning. A simple, basic website would also provide a cost-effective and affordable option for students belonging to institutions lacking the means to employ more complex, paid and traditional virtual learning platforms.

## Modules
<b>Login</b>
- Sign Up
- Student Login
- Teacher Login
<b>Student</b>
- Home: Details
- Add a note: Add a new note, view your notes, delete your notes
- Look for notes: Check notes publicly available to everyone (with search)
- Groups: list of groups student is in, add and view notes exclusive to the group
- Schedule: weekly calendar that lets you add events
<b>Teacher</b>
- Home: Details
- Add a note: Add a new note, view your notes, delete your notes
- Look for notes: Check notes publicly available to everyone (with search)
- Groups: Create a group, view groups, add notes for specific group
- Schedule: weekly calendar that lets you add events

## Database Design
- Student: <u>userId</u>, usern, pass, email, regNo, gender
- Teacher: <u>teachId</u>, usern, pass, email, gender
- Notes: <u>noteId</u>, noteAuthor, noten, notec, isTeacher (noteAuthor is userId or teachId)
- Groups: <u>groupId</u>, teachId, groupn
- Usergroups: userId, groupId (all groups that a userId is part of)
- Groupnotes: <u>noteId</u>, groupId, noteAuthor, noten, notec, isTeacher (noteAuthor is userId or teachId)
- Schedule: userId, title, fromT, toT, eventDay, isTeacher
- Tschedule: teachId, title, fromT, toT, eventDay, isTeacher
