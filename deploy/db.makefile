
DBES   := $(sort $(shell find $(DB_DIR) -type f -name '*.tag'))
O_DBES := $(patsubst $(IN_DIR)%, $(DEST_DIR)%, $(DBES))
TCHS   := $(DBES:=.tch)

all: build
build: $(CLOUD_FILE)
deploy: build $(O_DBES)

%.tch: %
	@echo Updating database for entry $<
	@touch $@
	@php5 -f $(TCH_TO_CLOUD) $< $(CLOUD_FILE)

$(CLOUD_FILE): $(TCHS)
	@echo Updating database…
	@touch $@

$(DEST_DIR)%.tag: $(IN_DIR)%.tag
	@echo Linking database entry $<
	@mkdir -p $(dir $@)
	@$(LN_CMD) $< $@

.PHONY: clean
clean:
	@echo Cleaning database
	@$(RM) $(O_DBES)
	@$(RM) $(CLOUD_FILE)
