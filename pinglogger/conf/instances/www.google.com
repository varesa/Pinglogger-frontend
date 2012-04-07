############################################
# Configuration for instance of pinglogger #
############################################

# Automatically start this configuration
# Only started by startall if true
AutoStart=false

# Address to be pinged
Address="www.google.com"

# Interval of pings
Interval=30